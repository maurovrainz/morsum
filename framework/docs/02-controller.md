# Controller

## Creates a controller with actions

Your controller class must extends from Morsum\Http\Controller, and the action must return a Morsum\Http\Response\Response object.
The action receives arguments passed by teh URL, and the Request instance.

```php
<?php
// src/Controller/DefaultController.php

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
```
As we can see, the action also returns a rendered view, but that render method, returns a Response object containing the view data.

## Defining routes

```php
<?php
// config/app.php

use Morsum\Application;
$loader = require __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/config.php';
$app = new Application($config);
// Default route
$app->addRoute('GET', '/', 'App\\Controller\\DefaultController', 'defaultAction', 'home');
$app->addRoute('GET', '/user/{id}/json', 'App\\Controller\\DefaultController', 'jsonProfile', 'ajax_profile');
return $app;
```

As we can see, the Application has a method to add routes to the Router component, so we register the routes for the two controller actions, defining the arguments as placeholders in the path.
