<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\{
    NotFoundHttpException,
    UnauthorizedHttpException,
    AccessDeniedHttpException,
    BadRequestHttpException,
    MethodNotAllowedHttpException,
    ServiceUnavailableHttpException,
    UnprocessableEntityHttpException,
    TooManyRequestsHttpException
};
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->getStatusCode(),
                   // 'message' => $e->getMessage()
                   'message' => 'Recurso nao encontrado'
                ], 404);
            }
        });

        $this->renderable(function (ServiceUnavailableHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->getStatusCode(),
                    'message' => 'Serviço Indisponivel1'
                ], 500);
            }
        });

        $this->renderable(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage()
                ], 500);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->status,
                    'message' =>  $e->validator->errors()->all(),
                ], 422);
            }
        });
        $this->renderable(function (InternalErrorException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Erro interno do servidor'
                ], 500);
            }
        });

        $this->renderable(function (UnprocessableEntityHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->getStatusCode(),
                    'message' => 'Formato invalidos recebidos.'
                ], 500);
            }
        });
        $this->renderable(function (TokenMismatchException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Sua sessão expirou.'
                ], 404);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->getStatusCode(),
                    'message' => 'metodo não permitido'
                ], 405);
            }
        });

        $this->renderable(function (TooManyRequestsHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => $e->getStatusCode(),
                    'message' => 'Muitas requisicões, aguarde!'
                ], 429);
            }
        });
    }
}
