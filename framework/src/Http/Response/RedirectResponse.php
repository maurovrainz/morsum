<?php

namespace Morsum\Http\Response;

class RedirectResponse extends Response
{
    public function __construct($url)
    {
        $headers['Location'] = $url;
        
        parent::__construct('', 200, $headers, false);
    }
}
