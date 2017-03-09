<?php

namespace Morsum\Http\Exceptions;

/**
 * NotFoundException
 *
 * @author mauro
 */
class NotFoundException extends HttpException
{
    public function __construct($message = "", $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
