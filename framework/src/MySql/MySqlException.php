<?php

namespace Morsum\MySql;

/**
 * MySqlException
 *
 * @author mauro
 */
class MySqlException extends \Exception
{
    const DEFAULT_MESSAGE = 'PDO has thrown and exception.';
    
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $message = empty($message) ? self::DEFAULT_MESSAGE : 'PDO Exception: ' . $message;
        parent::__construct($message, $code, $previous);
    }
}
