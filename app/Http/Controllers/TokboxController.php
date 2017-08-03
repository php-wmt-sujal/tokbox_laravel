<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use OpenTok\Role;
use Tomcorbett\OpentokLaravel\Facades\OpentokApi;


class TokboxController extends Controller
{
    public function index()
    {

        $session = OpentokApi::createSession();
        $sessionId = $session->getSessionId();

        //    echo $sessionId;

        if (empty($sessionId)) {
            throw new \Exception("An open tok session could not be created");
        }

        $api_key = '45931382';

        // note we're create a publisher token here, for subscriber tokens we would specify.. yep 'subscriber' instead
        $token = OpentokApi::generateToken($sessionId,
            array(
                'role' => Role::PUBLISHER
            )
        );

// pass these to your view where you're broadcasting from as you'll need them...
        return View::make('chat')
            ->with('session_id', $sessionId)
            ->with('api_key', $api_key)
            ->with('token', $token);
    }
}
