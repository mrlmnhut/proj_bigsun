<?php

namespace GuzzleHttp\Exception;

use Psr\Http\Message\RequestInterface;

/**
 * Exception thrown when a connection cannot be established.
 *
 * Note that no response is present for a ConnectException
 */
class ConnectException extends RequestException{

	public function __construct(
		$message,
		RequestInterface $request,
		\Exception $previous = NULL,
		array $handlerContext = []
	){
		parent::__construct($message, $request, NULL, $previous, $handlerContext);
	}

	/**
	 * @return null
	 */
	public function getResponse(){
		return NULL;
	}

	/**
	 * @return bool
	 */
	public function hasResponse(){
		return FALSE;
	}
}
