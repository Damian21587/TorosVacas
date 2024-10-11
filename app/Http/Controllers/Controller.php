<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $model;
    protected $view_index;
    protected $view_create;
    protected $view_edit;
    protected $view_show;
    protected $route_index;
    protected $route_create;
    protected $route_edit;
    protected $route_show;

    /**
     * Retorna respuesta satisfactoria codificada en JSON.
     *
     * @param $result
     * @param $message
     *
     * @return JsonResponse
     *
     * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
     * @version  1.0.0
     */
    public function sendSuccess($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Retorna respuesta insatisfactoria codificada en JSON.
     *
     * @param $message
     * @param array $errorMessages
     * @param int $code
     *
     * @return JsonResponse
     *
     * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
     * @version  1.0.0
     */
    public function sendError($message, $errorMessages = [], $code = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        if (null !== $code)
            return response()->json($response, $code);
        return response()->json($response);
    }

    /**
     * Redirecciona a la vista <em>$route</em> indicada con la notificaci&oacute;n exitosa <em>$message</em>.
     *
     * @param $message
     * @param $route
     *
     * @return RedirectResponse
     *
     * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
     * @version  1.0.0
     */
    public function redirectSuccess($message, $route = null)
    {
        if (null === $route) {
            $route = $this->route_index;
        }
        return redirect()->route($route)->with('success', $message);
    }

    /**
     * Redirecciona a la vista <em>$route</em> indicada con la notificaci&oacute;n fallida <em>$message</em>.
     *
     * @param $message
     * @param $route
     *
     * @return RedirectResponse
     *
     * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
     * @version  1.0.0
     */
    public function redirectFailed($message, $route = null)
    {
        if (null === $route) {
            $route = $this->route_index;
        }
        return redirect()->route($route)->with('failed', $message)->withInput();
    }

    public function redirectBack($message, $data = [], $route = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
        if (null !== $route) {
            return redirect()->route($route)->withInput()->withErrors($response);
        }
        return redirect()->back()->withInput()->withErrors($response);

    }
}
