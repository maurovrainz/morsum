<?php

namespace Morsum\Http\Factory;

use Morsum\Http\Request;

/**
 * RequestFactory class
 * Creates instances of Request class
 *
 * @author mauro
 */
class RequestFactory
{
    /**
     * 
     * @return Request
     */
    public static function create()
    {
        $session = !empty($_SESSION) ? $_SESSION : [];
        
        return new Request($_SERVER, $_GET, $_POST, $_FILES, $_COOKIE, $session);
    }
}
