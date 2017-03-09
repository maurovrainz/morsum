<?php

namespace Morsum\Routing;

use Morsum\Routing\Exceptions\RouteNotFoundException,
    Morsum\Routing\Exceptions\MissingArgumentException;

/**
 * Router class
 *
 * @author mauro
 */
class Router
{
    const WILDCARD_REGEX = '/\{[a-z]+\}/'; 
    const ARG_REGEX = '([a-zA-Z0-9\.\-\_\+]+)';

    /**
     *
     * @var array
     */
    protected $routes = [];

    public function match($path)
    {
        return $this->matchPath($path);
    }
    
    public function addRoute($path, array $data = [], $name = '')
    {
        if (empty($name)) {
            $this->routes[] = $this->createRoute($path, $data);
        } else {
            $this->routes[$name] = $this->createRoute($path, $data, $name);
        }
    }
    
    protected function matchPath($path)
    {
        foreach ($this->routes as $route) {
            $regex = $this->getRegex($route);
            if (!preg_match_all($regex, $path, $matches)) {
                continue;
            }
        
            $route['data']['args'] = [];
            if (count($matches) > 1) {
                array_shift($matches);

                $route['data']['args'] = array_map(function ($match) {
                    return $match[0];
                }, $matches);
            }
            
            return $route;
        }
        
        throw new RouteNotFoundException(sprintf('There is not route to match the follow path: %s', $path));
    }
    
    protected function createRoute($path, array $data = [], $name = '')
    {
        $route = [
            'path' => $path,
            'name' => $name,
            'data' => $data
        ];
        
        return $route;
    }
    
    protected function getRegex(array $route)
    {
        if (!preg_match_all(self::WILDCARD_REGEX, $route['path'], $matches)) {
            $regex = preg_quote($route['path'], '/');
            return '/' . $regex . '$/';
        }

        $tmp = uniqid('prefix_');
        
        $regex = $route['path'];
        foreach ($matches[0] as $match) {
            $regex = str_replace($match, $tmp, $regex);
        }
        $regex = preg_quote($regex, '/');
        $regex = str_replace($tmp, self::ARG_REGEX, $regex);
        
        return '/' . $regex . '$/';
    }
    
    /**
     * 
     * @param string $routeName
     * @param array $args
     * @return string
     * @throws RouteNotFoundException
     */
    public function generateUrl($routeName, array $args = [])
    {
        if (!array_key_exists($routeName, $this->routes)) {
            throw new RouteNotFoundException(sprintf('There is not route named %s', $routeName));
        }
        
        $route = $this->routes[$routeName];
        
        $url = $route['path'];
        
        $args = $this->prepareArgs($route, $args);
        
        foreach ($args['url'] as $key => $val) {
            $url = str_replace($key, $val, $url);
        }
        $query = http_build_query($args['query']);
        
        $url .= !empty($query) ? '?' . $query : '';
        
        return $url;
    }
    
    protected function prepareArgs(array $route, array $args = [])
    {
        if (!preg_match_all(self::WILDCARD_REGEX, $route['path'], $matches)) {
            // arguments as get
        }
        
        $prepared['url'] = [];
        foreach ($matches[0] as $match) {
            $key = str_replace('{', '', str_replace('}', '', $match));
            if (empty($args[$key])) {
                throw new MissingArgumentException(sprintf('Missing url argument %', $key));
            }
            
            $prepared['url'][$match] = $args[$key]; 
        }
        
        $prepared['query'] = [];
        foreach ($args as $key => $arg) {
            if (!array_key_exists('{' . $key . '}', $prepared['url'])) {
                $prepared['query'][$key] = $arg;
            }
        }
        
        return $prepared;
    }

}
