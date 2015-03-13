<?php

namespace anlutro\L4SmartErrors;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class SmartErrorsExceptionHandler extends ExceptionHandler {

	public function render($request, Exception $e)
	{
		global $app;
		$smarterror = $app['smarterror'];
		if ($smarterror) {
			$response = $smarterror->handleException($e);
			if ($response instanceof \Illuminate\Http\Response) {
				// reponse from exception handler
				return $response;
			} else if ($response) {
				// error in exception handler
				return new \Illuminate\Http\Response($response);
			}
		}
		// use default exception render
		return parent::render($request, $e);
	}

}
