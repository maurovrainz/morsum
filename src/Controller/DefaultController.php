<?php

namespace App\Controller;

use Morsum\Http\Controller;
use Morsum\Http\Request;
use Morsum\Http\Response\JsonResponse;

use Morsum\Http\Exceptions\BadHttpRequestException;

/**
 * DefaultController
 *
 * @author mauro
 */
class DefaultController extends Controller
{
    
    public function defaultAction() {
        $users = $this->getModel('user')->findAll();
        
        return $this->app->render('defaultTemplate.php', ['users' => $users]);
    }
    
    public function jsonProfile($id, Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadHttpRequestException('Invalid ajax request');
        }
        
        $user = $this->getModel('user')->find($id);
        
        return new JsonResponse($user);
    }
}
