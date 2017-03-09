<?php

namespace Morsum\MySql;

class Model
{
    const DEFAULT_ID = 'id';
    const DEFAULT_POSTFIX = 'Model';
    
    /**
     *
     * @var \PDO
     */
    protected $conn;
    
    /**
     *
     * @var string
     */
    protected $table;
    
    public function __construct(\PDO $conn, $table)
    {
        $this->conn = $conn;
        $this->table = $table;
    }
    
    /**
     * 
     * @param mixed $id
     * @param string $idField
     * @return array|null
     * @throws MySqlException
     */
    public function find($id, $idField = self::DEFAULT_ID)
    {
        $query = 'SELECT * '
            . 'FROM `' . $this->table . '` t '
            . 'WHERE t.' . $idField .' = :id';
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
        
        return empty($result) ? null : $result;
    }
    
    /**
     * 
     * @param array $parameters
     * @return array
     * @throws MySqlException
     */
    public function findOneBy(array $parameters)
    {
        $query = 'SELECT * '
            . 'FROM `' . $this->table . '` t ';
        
        $criteria = $this->prepareCriteria($parameters);
        $query .= 'WHERE ' . $criteria['query'];
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($criteria['params']);
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
    
    /**
     * 
     * @param array $parameters
     * @return array
     * @throws MySqlException
     */
    public function findBy(array $parameters)
    {
        $query = 'SELECT * '
            . 'FROM `' . $this->table . '` t ';
        
        $criteria = $this->prepareCriteria($parameters);
        $query .= 'WHERE ' . $criteria['query'];
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($criteria['params']);
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
    
    public function findAll()
    {
        $query = 'SELECT * FROM `' . $this->table . '` t';
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
    
    /**
     * 
     * @param array $parameters
     * @return array
     */
    protected function prepareCriteria(array $parameters)
    {
        $criteriaCollection = [];
        $params = [];
        foreach ($parameters as $field => $value) {
            if (is_null($value)) {
                $criteriaCollection[] = sprintf('t.%s IS NULL', $field);
            } else {
                $criteriaCollection[] = sprintf('t.%s = :%sParam', $field, $field);
                $params[sprintf(':%sParam', $field)] = $value;
            }
        }
        
        $criteria['query'] = implode(' AND ', $criteriaCollection);
        $criteria['params'] = $params;
        
        return $criteria;
    }
    
    /**
     * 
     * @param array $values
     * @return boolean
     * @throws MySqlException
     */
    public function insert(array $values)
    {
        $query = 'INSERT INTO `' . $this->table . '` ';
        
        $fields = [];
        $placeholders = [];
        $params = [];
        foreach ($values as $field => $value) {
            $fields[] = '`' . $field . '`';
            $placeholders[] = ':' . $field;
            $params[':' . $field] = $value;
        }
        
        $query .= '(' . implode(',', $fields) . ') VALUES'
            . '(' . implode(',', $placeholders) . ')';
        
        try {
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
    
    /**
     * 
     * @param array $values
     * @return boolean
     * @throws MySqlException
     */
    public function update(array $values, array $filters = [])
    {
        $query = 'UPDATE `' . $this->table . '` t SET ';
        
        $fields = [];
        $params = [];
        foreach ($values as $field => $value) {
            $fields[] = 't.`' . $field . '` = :' . $field;
            $params[':' . $field] = $value;
        }
        
        $query .= implode(', ', $fields) . ' ';
        
        $criteria = $this->prepareCriteria($filters);
        $query .= 'WHERE ' . $criteria['query'];
        
        $params = array_merge($params, $criteria['params']);
        
        try {
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new MySqlException($e->getMessage());
        }
    }
}
