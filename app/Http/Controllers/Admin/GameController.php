<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGameRequest;
use App\Models\Game;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private $maxTime = 60;

    public function __construct()
    {
        $this->view_index = 'admin.games.index';
        $this->view_create = 'admin.games.create';
        $this->view_edit = 'admin.games.edit';

        $this->route_index = 'admin.content.game.index';
        $this->route_create = 'admin.content.game.create';

        $this->middleware('hasPermission:game.create')->only(['create', 'store']);
        $this->middleware('hasPermission:game.destroy')->only(['destroy']);
        $this->middleware('hasPermission:game.index')->only(['index']);
        $this->middleware('hasPermission:game.edit')->only(['update', 'edit']);
    }

    /**
     * Display a listing of the BullsCows.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $count = count(Game::all());
        $games = Game::orderBy('evaluation', 'desc')->paginate($count);
        return view($this->view_index, compact('games'));
    }

    public function create()
    {
        $players = User::orderBy('score', 'desc')->get();
        return view($this->view_create, compact('players'));
    }

    /**
     * Store a newly created Charge in storage.
     *
     * @param CreateGameRequest $request
     *
     * @return Response
     */
    public function store(CreateGameRequest $request)
    {
        /** @var Game $game */
        DB::beginTransaction();
        $input = $request->validated();
        $secretNumber = $request->session()->get('secret_number', $this->generateRandomNumber());// Example secret number
        $request->session()->put('secret_number', $secretNumber);
        $player = User::find($input['user_id']);
        $startTime = $request->session()->get('start_time', microtime(true)); // Get or set start time
        $request->session()->put('start_time', $startTime); // Store start time in session
        /*$attempts = Game::where('user_id', $player->id)->count() + 1;*/
        $attempts = $request->session()->get('attempts', Game::where('user_id', $player->id)->count()) + 1;
        $request->session()->put('attempts', $attempts);

        if ($this->isDuplicateGuess($player->id, $input['guess'])) {
            return view($this->view_create, [
                'message' => 'Duplicate guess! The digits were already sent previously in the same order.',
                'players' => User::orderBy('score', 'desc')->get(),
            ]);
        }

        $result = $this->getBullsAndCows($secretNumber, $input['guess']);

        $currentTime = microtime(true);
        $timeTaken = $currentTime - $startTime;
        if ($timeTaken > $this->maxTime) {
            $request->session()->forget(['start_time', 'secret_number', 'attempts']);
            return view('admin.games.game_over',
                ['message' => 'The maximum game time has been reached.',
                    'secretNumber' => $secretNumber,]);
        }

        $won = $result['bulls'] === strlen($secretNumber);
        if ($won) {
            $request->session()->forget(['start_time', 'secret_number', 'attempts']);
        }

        $evaluation = round(($timeTaken / 2) + $attempts, 2);

        $game = $player->games()->create([
            'secret_number' => $secretNumber,
            'guess' => $input['guess'],
            'bulls' => $result['bulls'],
            'age' => $input['age'],
            'cows' => $result['cows'],
            'attempts' => $attempts,
            'evaluation' => $evaluation,
            'won' => $won
        ]);
        $player->score += $result['bulls'];

        if ($player->save()) {
            DB::commit();
            $ranking = $this->calculateRanking($player->id, $evaluation, $won);
            return view($this->view_create, [
                'result' => $result,
                'guess' => $input['guess'],
                'attempts' => $attempts,
                'evaluation' => $evaluation,
                'ranking' => $ranking,
                'secretNumber' => $secretNumber,
                'players' => User::orderBy('score', 'desc')->get(),
            ]);
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Juego']));
    }

    private function getBullsAndCows($secretNumber, $guess)
    {
        $bulls = 0;
        $cows = 0;

        $secretArray = str_split($secretNumber);
        $guessArray = str_split($guess);

        for ($i = 0; $i < count($secretArray); $i++) {
            if ($secretArray[$i] == $guessArray[$i]) {
                $bulls++;
            }
        }

        $secretCount = array_count_values($secretArray);
        $guessCount = array_count_values($guessArray);

        foreach ($guessCount as $digit => $count) {
            if (isset($secretCount[$digit])) {
                $cows += min($secretCount[$digit], $count);
            }
        }

        $cows -= $bulls;

        return ['bulls' => $bulls, 'cows' => $cows];
    }

    private function generateRandomNumber()
    {
        $digits = range(1, 9);
        shuffle($digits);
        return implode('', array_slice($digits, 0, 4));
    }

    private function isDuplicateGuess($playerId, $guess)
    {
        return Game::where('user_id', $playerId)->where('guess', $guess)->exists();
    }

    private function calculateRanking($playerId, $currentEvaluation, $currentWon)
    {
        $games = Game::orderBy('won', 'desc')
            ->orderBy('evaluation', 'asc')
            ->get();
        $rank = 1;
        foreach ($games as $game) {
            if ($game->user_id == $playerId && $game->evaluation <= $currentEvaluation && $game->won == $currentWon) {
                return $rank;
            }
            $rank++;
        }
        return $rank;
    }

    /**
     * Remove the specified Charge from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Game $game */
        try {
            /* DB::beginTransaction();*/
            $game = Game::find($id);
            if (empty($game))
                return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Juego']));

            if ($game) {
                Game::destroy($id);
                /* DB::commit();*/
                return $this->redirectSuccess(__('general.delete-content', ['contenido' => 'Juego']));
            }
            /*DB::rollback();*/
            return $this->redirectFailed(__('general.error-content', ['contenido' => 'Juego']));
        } catch (Exception $e) {
            return $this->redirectFailed(__('general.error-content-delete', ['contenido' => 'Juego']));
        }
    }

}
