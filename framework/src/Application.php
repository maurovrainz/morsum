<?php

namespace Morsum;

use Morsum\Routing\Router,
    Morsum\Routing\Interfaces\RuteableInterface,
    Morsum\Routing\Traits\RoutingTrait;
use Morsum\Traits\ContainerTrait;

use Morsum\Http\Traits\TemplatingTrait;
use Morsum\Resolver;
use Morsum\Http\Factory\RequestFactory;

/**
 * Framework main class
 *
 * @author mauro
 */
class Application implements RuteableInterface, \ArrayAccess
{
    use RoutingTrait;
    use TemplatingTrait;
    use ContainerTrait;
    
    /**
     *
     * @var Resolver
     */
    protected $resolver;
    
    public function __construct()
    {
        $this['router'] = new Router();
        
        $this->resolver = new Resolver($this);
    }
    
    public function run()
    {
        $request = RequestFactory::create();
        $route = $this['router']->match($request->server['PATH_INFO']);
        
        $request->setRoutingInfo($route);
        $response = $this->resolver->resolve($request);
        
        $response->send();
        exit();
    }
}
