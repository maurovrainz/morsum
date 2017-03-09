<?php

namespace Morsum\Exceptions;

/**
 * InvalidResponseException
 *
 * @author mauro
 */
class InvalidResponseException extends MorsumException
{
    const DEFAULT_MESSAGE = 'The Controller must return a valid Response.';
    
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $message = empty($message) ? self::DEFAULT_MESSAGE : $message;
        parent::__construct($message, $code, $previous);
    }
}
