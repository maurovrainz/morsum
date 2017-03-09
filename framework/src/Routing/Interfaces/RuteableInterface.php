<?php

namespace Morsum\Routing\Interfaces;

use Morsum\Routing\Router;

/**
 * RuteableInterface
 *
 * @author mauro
 */
interface RuteableInterface
{
    public function addRoute($method, $path, $controller, $action, $name = '');
    
    public function generateUrl($routeName);
    
}
