<?php

namespace App\Controller;

use Morsum\Http\Controller;
use Morsum\Http\Request;
use Morsum\Http\Response\JsonResponse;

use Morsum\Http\Exceptions\BadHttpRequestException;

/**
 * MusicController
 *
 * @author mauro
 */
class MusicController extends Controller
{
    
    public function lastfmTopTen() {
        
        $artists = $this->app['lastfm_service']->getTopTenArtists();
        //var_dump($artists); die;
        return $this->app->render('lastfmTopTen.php', ['artists' => $artists['artists']['artist']]);
    }
}
