<?php

namespace Morsum;

/**
 * Container class
 * Used to store values or classes instances, like services
 *
 * @author mauro
 */
class Container implements \ArrayAccess
{
    /**
     *
     * @var array
     */
    protected $container = [];
    
    /**
     *
     * @var array
     */
    protected $containerInstances = [];
    
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->container);
    }

    public function offsetGet($offset)
    {
        if (is_callable($this->container[$offset])) {
            if (!array_key_exists($offset, $this->containerInstances)) {
                $this->containerInstances[$offset] = call_user_func($this->container[$offset]);
            }
            
            return $this->containerInstances[$offset];
        }
        return $this->container[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}
