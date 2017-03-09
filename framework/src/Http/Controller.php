<?php

namespace Morsum\Http;

use Morsum\Application;
use Morsum\MySql\MySql;
use Morsum\MySql\Model;

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
    
    /**
     * 
     * @return MySql
     */
    public function getMySql()
    {
        return $this->app['mysql'];
    }
    
    /**
     * 
     * @param string $table
     * @return Model
     */
    public function getModel($table)
    {
        return $this->app['mysql']->getModel($table);
    }
}
