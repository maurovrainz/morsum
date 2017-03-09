<?php

namespace Morsum\Http;

/**
 * Request class
 *
 * @author mauro
 */
class Request
{
    /**
     *
     * @var array
     */
    public $server;
    
    /**
     *
     * @var array
     */
    public $get;
    
    /**
     *
     * @var array
     */
    public $post;
    
    /**
     *
     * @var array
     */
    public $cookies;
    
    /**
     *
     * @var array
     */
    public $files;
    
    /**
     *
     * @var array
     */
    public $session;
    
    /**
     *
     * @var array
     */
    protected $routingInfo;
    
    public function __construct(
        array $server,
        array $get,
        array $post,
        array $files,
        array $cookies,
        array $session
    )
    {
        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookies = $cookies;
        $this->session = $session;
    }
    
    /**
     * 
     * @param array $routingInfo
     */
    public function setRoutingInfo(array $routingInfo)
    {
        $this->routingInfo = $routingInfo;
    }
    
    /**
     * 
     * @return array
     */
    public function getRoutingInfo()
    {
        return $this->routingInfo;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isXmlHttpRequest()
    {
        return (
            !empty($this->server['HTTP_X_REQUESTED_WITH']) 
            && strtolower($this->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        );
    }
}
