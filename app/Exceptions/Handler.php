<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Handle HTTP exceptions with custom error pages
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
            
            // Use specific error pages based on status code
            switch ($status) {
                case 404:
                    return response()->view('errors.404', [], 404);
                case 500:
                    return response()->view('errors.500', [], 500);
                case 403:
                    return response()->view('errors.404', [], 403); // Use 404 page for 403
                case 401:
                    return response()->view('errors.404', [], 401); // Use 404 page for 401
                default:
                    return response()->view('errors.404', [], $status);
            }
        }

        // For non-HTTP exceptions, use the 500 error page
        if ($this->isHttpException($exception)) {
            return response()->view('errors.500', [], 500);
        }

        return parent::render($request, $exception);
    }
}
