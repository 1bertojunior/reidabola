<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    protected $dontReport = [

    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
        
        });
    }

    
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof UnauthorizedHttpException && $exception->getMessage() === 'The token has been blacklisted') {
    //         return response()->json(['error' => 'The token has been added to the blacklist'], 401);
    //     }

    //     if ($exception instanceof UnauthorizedHttpException && $exception->getMessage() === 'Token not provided') {
    //         return response()->json(['error' => 'Token not provided'], 401);
    //     }

    //     if ($exception instanceof UnauthorizedHttpException && $exception->getMessage() === 'Token Signature could not be verified.') {
    //         return response()->json(['error' => 'Token signature could not be verified'], 401);
    //     }

    //     if ($exception instanceof UnauthorizedHttpException) {
    //         return response()->json(['error' => 'Unauthorized access'], 401);
    //     }

    //     if ($exception instanceof QueryException) {
    //         Log::error('Database Error: ' . $exception->getMessage());
    //         return response()->json(['error' => 'Database error'], 500);
    //     }

    //     if ($exception instanceof AuthenticationException) {
    //         return response()->json(['error' => 'Unauthenticated'], 401);
    //     }

    //     if ($exception instanceof AuthorizationException) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     if ($exception instanceof ModelNotFoundException) {
    //         return response()->json(['error' => 'Resource not found'], 404);
    //     }

    //     if ($exception instanceof ThrottleRequestsException) {
    //         return response()->json(['error' => 'Too Many Requests'], 429);
    //     }

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return response()->json(['error' => 'Method not allowed'], 405);
    //     }

    //     if ($exception instanceof HttpException) {
    //         return response()->json(['error' => 'Route error'], $exception->getStatusCode());
    //     }

    //     Log::error('Internal Server Error: ' . $exception->getMessage());
    //     return response()->json(['error' => 'Internal server error'], 500);
    // }

}
