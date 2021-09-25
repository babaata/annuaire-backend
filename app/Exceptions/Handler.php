<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Response;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                "message" => "Les données fournies sont invalides.",
                'status' => false,
                'errors' => $exception->errors()
            ]);
        }elseif ($exception instanceof NotFoundHttpException) {
            return response()->json([
                "message" => "La ressource demandée n'est pas disponible",
                'status' => false,
            ]);
        }elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                "message" => "Cette méthode n'est pas prise en charge pour cette route",
                'status' => false,
            ]);
        }elseif ($exception instanceof TokenInvalidException) {
            return response()->json([
                "message" => "Vous n'avez pas l'autorisation nécessaire pour accéder à cette page",
                'status' => false,
            ]);
        }elseif ($exception instanceof TokenExpiredException) {
            return response()->json([
                "message" => "Vous n'avez pas l'autorisation nécessaire pour accéder à cette page",
                'status' => false,
            ]);
        }elseif ($exception instanceof JWTException) {
            return response()->json([
                "message" => "Vous n'avez pas l'autorisation nécessaire pour accéder à cette page",
                'status' => false,
            ]);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Non authentifié',
                'status' => false,
            ]);
        }

        // return a plain 401 response even when not a json call
        return response('Non authentifié');
    }
}
