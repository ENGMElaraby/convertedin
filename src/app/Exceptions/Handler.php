<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Log;
use MElaraby\Emerald\Exceptions\ExceptionHandlerTrait;
use MElaraby\Emerald\HttpFoundation\Response;
use MElaraby\Emerald\RestfulAPI\RestTrait;
use Throwable;

class Handler extends ExceptionHandler
{
    use RestTrait, ExceptionHandlerTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [//
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = ['current_password', 'password', 'password_confirmation',];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    final public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($this->shouldReport($e) && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isApiCall($request)) {
            if (auth()->check() && auth()->id() == 8) {
                Log::channel('emerald')->info(json_encode([$request->url(), $this->errors, $exception->getMessage()]));
            }
//            return $this->getJsonResponseForException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    final protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        if (($this->isApiCall($request) || $request->ajax() || $request->wantsJson())) {
            return Response::response(['message' => 'Unauthenticated.', 'status' => 401]);
        }
        return Response::response(['redirect' => route('admin.login')]);

    }
}
