<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateGameAPIRequest;
use App\Http\Requests\API\UpdateGameAPIRequest;
use App\Models\Game;
use App\Repositories\GameRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class game1Controller
 * @package App\Http\Controllers\API
 */

class GameAPIController extends Controller
{
    /** @var  gameRepository */
    private $gameRepository;

    public function __construct(GameRepository $gameRepo)
    {
        $this->gameRepository = $gameRepo;
    }

    /**
     * Display a listing of the game.
     * GET|HEAD /games
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $games = $this->gameRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($games->toArray(), 'Games retrieved successfully');
    }

    /**
     * Store a newly created game in storage.
     * POST /games
     *
     * @param CreateGameAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGameAPIRequest $request)
    {
        $input = $request->all();

        $game = $this->gameRepository->create($input);

        return $this->sendResponse($game->toArray(), 'Game saved successfully');
    }

    /**
     * Display the specified game.
     * GET|HEAD /games/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var game $game */
        $game = $this->gameRepository->find($id);

        if (empty($game)) {
            return $this->sendError('Game not found');
        }

        return $this->sendResponse($game->toArray(), 'Game retrieved successfully');
    }

    /**
     * Update the specified game in storage.
     * PUT/PATCH /games/{id}
     *
     * @param int $id
     * @param UpdateGameAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGameAPIRequest $request)
    {
        $input = $request->all();

        /** @var game $game */
        $game = $this->gameRepository->find($id);

        if (empty($game)) {
            return $this->sendError('Game not found');
        }

        $game = $this->gameRepository->update($input, $id);

        return $this->sendResponse($game->toArray(), 'game updated successfully');
    }

    /**
     * Remove the specified game from storage.
     * DELETE /games/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var game $game */
        $game = $this->gameRepository->find($id);

        if (empty($game)) {
            return $this->sendError('Game not found');
        }

        $game->delete();

        return $this->sendSuccess('Game deleted successfully');
    }
}
