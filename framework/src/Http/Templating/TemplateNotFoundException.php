<?php

namespace Morsum\Http\Templating;

use Morsum\Exceptions\MorsumException;

/**
 * TemplateNotFoundException
 *
 * @author mauro
 */
class TemplateNotFoundException extends MorsumException
{
    const MESSAGE_TEMPLATE = 'Template not found: %s';
    
}
