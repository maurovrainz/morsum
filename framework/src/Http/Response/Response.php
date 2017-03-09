<?php

namespace Morsum\Http\Response;

class Response
{
    /**
     *
     * @var string
     */
    public $content;
    
    /**
     *
     * @var array
     */
    public $headers;
    
    /**
     *
     * @var int
     */
    public $code;
    
    /**
     *
     * @var boolean
     */
    public $displayContent;
    
    public function __construct($content, $code = 200, array $headers = [], $displayContent = true)
    {
        $this->content = $content;
        $this->code = $code;
        $this->headers = $headers;
        $this->displayContent = $displayContent;
    }
    
    public function send()
    {
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
        
        if ($this->displayContent) {
            echo $this->content;
        }
    }
}
