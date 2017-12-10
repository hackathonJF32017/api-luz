<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Usuario;
use Models\Perfil;
use Models\Setor;

class Auth {

    public function login(Request $request, Response $response) {
        
        $data = $request->getParsedBody();

        $user = Usuario::where('no_login', $data['no_login'])->first();

        if($user) {
            if($user->co_password == sha1($data['co_password'])) {
                
                $user->last_access = (new \DateTime())->format('Y-m-d H:i:s');
                $user->save();
                
                $data = array(
                    'id' => $user->co_usuario,
                    'password' => $user->co_password,
                    'access_date' => $user->last_access
                );

                $token = \Crypt::encrypt($data);

                return $response->withJson(array(
                    'token' => $token
                ), 200);

            } else {
                return $response->withJson([
                    'error' => '000',
                    'message' => 'Incorrect password'
                ], 400);
            }
        } else {
            return $response->withJson([
                'error' => '000',
                'message' => 'User not found'
            ], 400);
        }
    }

    public function create(Request $request, Response $response) { 

        $data = $request->getParsedBody();

        $user = new Usuario();
        $user->no_login = $data['no_login'];
        $user->no_nome = $data['no_nome'];
        $user->co_password = sha1($data['co_password']);
        $user->last_access = (new \DateTime())->format('Y-m-d H:i:s');
        $user->perfil()->associate(Perfil::find($data['co_perfil']));
        $user->setor()->associate(Setor::find($data['co_setor']));
        
        if($user->save()) {
            
            $data = array(
                'id' => $user->co_usuario,
                'password' => $user->co_password,
                'access_date' => $user->last_access
            );

            $token = \Crypt::encrypt($data);

            return $response->withJson(array(
                'token' => $token
            ), 200);

        } else {
            return $response->withJson(array(123), 400);
        }
    }
}