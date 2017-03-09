<?php

namespace Morsum\Http\Exceptions;

use Morsum\Exceptions\MorsumException;

/**
 * HttpException
 *
 * @author mauro
 */
class HttpException extends MorsumException
{
    public function __construct($message = "", $code = 500, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
