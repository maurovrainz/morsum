<?php

namespace Morsum\MySql;

/**
 * MySQL Connector entity
 *
 * @author mauro
 */
class Connector
{

    const DSN_TEMPLATE = 'mysql:dbname=%s;host=%s';
    
    /**
     *
     * @var array
     */
    protected $config = [];
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * 
     * @return \PDO
     * @throws MySqlException
     */
    public function connect()
    {
        $this->config;
        
        $dsn = sprintf(self::DSN_TEMPLATE, $this->config['dbname'], $this->config['host']);
        $port = isset($this->config['port']) ? $this->config['port'] : '';
        
        if (!empty($port)) {
            $dsn .= ';port=' . $port;
        }
        
        try {
            return new \PDO($dsn, $this->config['user'], $this->config['passwd']);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
    
    /**
     * 
     * @param array $config
     * @throws MySqlException
     */
    protected function configValidation(array $config)
    {
        $error = empty($config['user']) ? 'Missing parameter user' : null;
        $error = empty($config['dbname']) ? 'Missing parameter dbname' : $error;
        $error = empty($config['host']) ? 'Missing parameter host' : $error;
        
        if (!is_null($error)) {
            throw new MySqlException('MySql configuration error: ' . $error);
        }
    }

}
