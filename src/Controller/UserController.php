<?php

namespace App\Controller;

use Morsum\Http\Controller;
use Morsum\Http\Request;

/**
 * UserController
 *
 * @author mauro
 */
class UserController extends Controller
{
    
    public function getProfile($id, $type, Request $request) {
        return $this->app->render('profile.php', ['id' => $id, 'type' => $type]);
    }
    
    public function getBilling($id, $type) {
        return $this->app->render('profile.php', ['id' => $id, 'type' => $type]);
    }
    
}
