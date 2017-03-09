<?php

namespace Morsum\Http\Response;

class JsonResponse extends Response
{
    public function __construct(array $content, $code = 200, array $headers = [])
    {
        $json = json_encode($content);
        $headers['Content-Type'] = 'application/json';
        
        parent::__construct($json, $code, $headers);
    }
}
