<?php

namespace Morsum\Http;

use Morsum\Application;

/**
 * Base Controller
 *
 * @author mauro
 */
abstract class Controller
{
    /**
     *
     * @var Application
     */
    protected $app;
    
    /**
     * 
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
