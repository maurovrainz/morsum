<?php

namespace Morsum;

use Morsum\Http\Request;
use Morsum\Http\Response;
use Morsum\Application;
use Morsum\Http\Controller;
use Morsum\Exceptions\InvalidResponseException;

/**
 * Resolver class
 *
 * @author mauro
 */
class Resolver
{
    
    /**
     *
     * @var Application 
     */
    protected $app;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * 
     * @param Request $request
     * @return Response
     */
    public function resolve(Request $request)
    {
        $route = $request->getRoutingInfo();
        
        $controller = new $route['data']['controller']($this->app);
        
        $response = $this->callController(
            $controller,
            $route['data']['action'],
            $request,
            $route['data']['args']
        );
        
        return $response;
    }
    
    private function callController(Controller $controller, $action, Request $request, array $args = [])
    {
        $args[] = $request;
        $response = call_user_func_array([
            $controller, $action
        ], $args);
        
        if (!($response instanceof Response)) {
            throw new InvalidResponseException();
        }
        
        return $response;
    }
}