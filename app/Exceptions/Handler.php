<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        // $this->renderable(function($exception, $request) {
        //     // if ($exception instanceof ValidationException) {
        //     //     return response()->json([
        //     //         "message" => "Les données fournies sont invalides.",
        //     //         'errors' => $exception->errors()
        //     //     ]);
        //     // } 
        // });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                "message" => "Les données fournies sont invalides.",
                'errors' => $exception->errors()
            ]);
        }elseif ($exception instanceof NotFoundHttpException) {
            return response()->json(["message" => "La ressource demandée n'est pas disponible"]);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Non authentifié']);
        }

        // return a plain 401 response even when not a json call
        return response('Non authentifié');
    }
}
