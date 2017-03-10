<?php

namespace Morsum\MySql;

use Morsum\Container;

/**
 * MySql main class
 *
 * @author mauro
 */
class MySql
{
    /**
     *
     * @var array
     */
    protected $config;
    
    /**
     *
     * @var \PDO
     */
    protected $connection = null;
    
    /**
     *
     * @var Connector
     */
    protected $connector;
    
    /**
     *
     * @var Container
     */
    protected $container;
    
    public function __construct(Container $container, array $config)
    {
        $this->container = $container;
        $this->config = $config;
        $this->connector = new Connector($config['connection']);
    }
    
    /**
     * Creates the connection
     * 
     * @return \PDO
     */
    public function connect()
    {
        return $this->getConnection();
    }
    
    /**
     * Returns the connection
     * 
     * @return \PDO
     */
    public function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = $this->connector->connect();
        }

        return $this->connection;
    }
    
    /**
     * Returns a Model instance
     * 
     * @param string $table
     * @return Model
     */
    public function getModel($table)
    {
        if (!isset($this->container['models.' . $table])) {
            $this->container['models.' . $table] = ModelFactory::create(
                $this->connection,
                $table, 
                $this->config['models_dir']
            );
        }
        
        return $this->container['models.' . $table];
    }
    
}
