<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Ideia;
use Models\Usuario;
use Models\Comentario;

class Comentarios {
    
    public function create(Request $request, Response $response) {

        $id = $request->getAttribute('id');
        $token = \Crypt::decrypt($_SERVER['HTTP_APP_TOKEN']);
        
        $user  = Usuario::find($token['id']);
        $ideia = Ideia::find($id);

        if($ideia) {
            $data = $request->getParsedBody();

            $comentario = new Comentario();
            $comentario->ideia()->associate($ideia);
            $comentario->usuario()->associate($user);
            $comentario->de_comentario = $data['de_comentario'];

            if($comentario->save()) {
                return $response->withJson($comentario->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Comentario create error'
                ), 400);
            }
            
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function list(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $ideia = Ideia::find($id);
        if($ideia) {
            return $response->withJson($ideia->comentarios->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute('comentario_id');
        $comentario = Comentario::find($id);
        if($comentario) {
            return $response->withJson($comentario->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Comentario not found'
            ), 400);
        }
    }

    public function update(Request $request, Response $response) {
        $id = $request->getAttribute('comentario_id');
        $comentario = Comentario::find($id);
        if($comentario) {
            $data = $request->getParsedBody();
            $comentario->de_comentario = $data['de_comentario'];
            if($comentario->save()) {
                return $response->withJson($comentario->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Comentario update error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Comentario not found'
            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute('comentario_id');
        $comentario = Comentario::find($id);
        if($comentario) {
            if($comentario->delete()) {
                return $response->withJson(array(
                    'message' => 'OK'
                ), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Comentario delete error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Comentario not found'
            ), 400);
        }
    }

}