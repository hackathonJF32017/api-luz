<?php

namespace Middlewares;

use Models\Usuario;

class Auth {

    private $timeSpitToken = 3600;

    public function __invoke($request, $response, $next) {

        if (isset($_SERVER["HTTP_APP_TOKEN"])) {
            
            $params = \Crypt::decrypt($_SERVER["HTTP_APP_TOKEN"]);
            $time_access = \Helpers::getMinutes($params['access_date']);
            
            if ($time_access < $this->timeSpitToken) {

                $user = Usuario::find($params['id']);

                if ($user->co_usuario == $params['id'] && $user->co_password == $params['password']) {
                    return $response = $next($request, $response);
                } else {
                    return $response->withJson([
                        'error' => '005',
                        'message' => 'Invalid credentials'
                    ], 401);
                }
            } else {
                return $response->withJson([
                    'error' => '002',
                    'message' => 'Session timeout, expired token'
                ], 400);
            }
        } else {
            return $response->withJson([
                'error' => '001',
                'message' => 'Invalid token'
            ], 401);
        }

    }
}