<?php

namespace Morsum\Http\Exceptions;

/**
 * BadHttpRequestException
 *
 * @author mauro
 */
class BadHttpRequestException extends HttpException
{
    public function __construct($message = "", $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
