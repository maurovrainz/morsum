<?php

namespace Morsum;

use Morsum\Routing\Router,
    Morsum\Routing\Interfaces\RuteableInterface,
    Morsum\Routing\Traits\RoutingTrait;

use Morsum\Http\Templating\TemplatingTrait;
use Morsum\Resolver;
use Morsum\Http\Factory\RequestFactory;

use Morsum\MySql\MySql;

/**
 * Framework main class
 *
 * @author mauro
 */
class Application extends Container implements RuteableInterface
{
    use RoutingTrait;
    use TemplatingTrait;
    
    /**
     *
     * @var Resolver
     */
    protected $resolver;
    
    public function __construct(array $config = [])
    {
        $this['config'] = $config;
        $this['router'] = new Router();
        $this->setUpMysql();
        $this->resolver = new Resolver($this);
    }
    
    /*
     * Process the Request and send a Response
     */
    public function run()
    {
        $request = RequestFactory::create();
        $route = $this['router']->match(isset($request->server['PATH_INFO']) ? $request->server['PATH_INFO'] : '/');
        
        $request->setRoutingInfo($route);
        $this['request'] = $request;
        $response = $this->resolver->resolve($request);
        
        $response->send();
        exit();
    }
    
    /**
     * Setup the Mysql provider
     */
    protected function setUpMysql()
    {
        if(array_key_exists('mysql', $this['config'])) {
            $this['mysql'] = function () {
                $mysql = new MySql($this, $this['config']['mysql']);
                $mysql->connect();
                return $mysql;
            };
        }
    }
}
