<?php

namespace Morsum\Http\Traits;

use Morsum\Http\Response;

/**
 * TemplatingTrait
 *
 * @author mauro
 */
trait TemplatingTrait
{
    /**
     * 
     * @param string $template
     * @param array $args
     * @return string
     */
    public function render($template, array $args = [])
    {
        extract($args);
        ob_start();
        
        include $this['config']['framework']['templates_dir'] . '/' . $template;

        return new Response(ob_get_clean());
    }
}
