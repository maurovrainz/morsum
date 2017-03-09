<?php

namespace Morsum\MySql;

/**
 * ModelFactory
 *
 * @author mauro
 */
class ModelFactory
{
    /**
     * 
     * @param type $table
     * @param type $modelsDir
     * @return Model
     */
    public static function create(\PDO $conn, $table, $modelsDir)
    {
        $modelName = self::camelize($table);
        $modelClass = self::getModelClass($modelName, $modelsDir);
        if (file_exists($modelClass)) {
            $model = new $modelClass($conn, $table);
            if (!($model instanceof Model)) {
                throw new MySqlException(sprintf('Class %s must extend Model class', $modelClass));
            }
        } else {
            $model = new Model($conn, $table);
        }
        
        
        return $model;
    }
    
    /**
     * 
     * @param string $table
     * @return string
     */
    protected static function camelize($table)
    {
        $delimiters = ['-', '_'];
        $camelized = ucfirst($table);
        
        foreach ($delimiters as $d) {
            $words = explode($d, $camelized);
            if (count($words) < 2) {
                continue;
            }
            $words = array_map('ucfirst', $words);
            $camelized = implode('', $words);
        }
        
        return $camelized;
    }
    
    /**
     * 
     * @param string $modelName
     * @param string $modelsDir
     * @return string
     */
    protected static function getModelClass($modelName, $modelsDir)
    {
        return $modelsDir . DIRECTORY_SEPARATOR . $modelName . Model::DEFAULT_POSTFIX;
    }
}
