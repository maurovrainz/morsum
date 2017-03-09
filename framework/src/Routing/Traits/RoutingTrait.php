<?php

namespace Morsum\Routing\Traits;

/**
 * RoutingTrait
 *
 * @author mauro
 */
trait RoutingTrait
{
    public function addRoute($method, $path, $controller, $action, $name = '')
    {
        $data = [
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];
        $this['router']->addRoute($path, $data, $name);
    }
    
    public function generateUrl($routeName)
    {
        
    }
}
