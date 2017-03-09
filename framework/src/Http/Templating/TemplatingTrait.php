<?php

namespace Morsum\Http\Templating;

use Morsum\Http\Response\Response;

/**
 * TemplatingTrait
 *
 * @author mauro
 */
trait TemplatingTrait
{
    /**
     * 
     * @param string $_template
     * @param array $_args
     * @return string
     */
    public function render($_template, array $_args = [])
    {
        $_path = $this->getTemplatePath($_template);
        
        extract($_args);
        $app = $this;
        ob_start();
        include $_path;

        return new Response(ob_get_clean());
    }
    
    /**
     * 
     * @param string $template
     * @return string
     * @throws TemplateNotFoundException
     */
    protected function getTemplatePath($template)
    {
        $path = $this['config']['framework']['templates_dir'] . '/' . $template;
        
        if (!file_exists($path)) {
            throw new TemplateNotFoundException(sprintf(TemplateNotFoundException::MESSAGE_TEMPLATE, $path));
        }
        
        return $path;
    }
}
