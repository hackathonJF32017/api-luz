<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Apoio;
use Models\Ideia;
use Models\Usuario;
use Models\Comentario;

class Apoios {
    
    public function create(Request $request, Response $response) {

        $id_ideia = $request->getAttribute('id');
        $id_comentario = $request->getAttribute('comentario_id');

        $token = \Crypt::decrypt($_SERVER['HTTP_APP_TOKEN']);

        $user  = Usuario::find($token['id']);

        $ideia = Ideia::find($id_ideia);
        $comentario = Comentario::find($id_comentario);
        if($comentario) {
            $apoio = new Apoio();
            $apoio->ideia()->associate($ideia);
            $apoio->comentario()->associate($comentario);
            $apoio->usuario()->associate($user);
            if($apoio->save()) {
                return $response->withJson($apoio->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Apoio create error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Comentario not found'
            ), 400);
        }

    }

    public function createFromIdeia(Request $request, Response $response) {
        
        $id_ideia = $request->getAttribute('id');

        $token = \Crypt::decrypt($_SERVER['HTTP_APP_TOKEN']);
        $user  = Usuario::find($token['id']);
        $ideia = Ideia::find($id_ideia);

        if($ideia) {
            $apoio = new Apoio();
            $apoio->ideia()->associate($ideia);
            $apoio->usuario()->associate($user);
            if($apoio->save()) {
                return $response->withJson($apoio->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Apoio create error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function listByComment(Request $request, Response $response) {
        $id = $request->getAttribute("comentario_id");
        $comentario = Comentario::find($id);
        if($comentario) {
            return $response->withJson($comentario->apoios->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Comentario not found'
            ), 400);
        }
    }

    public function listByIdeia(Request $request, Response $response) {
        $id = $request->getAttribute("id");
        $ideia = Ideia::find($id);
        if($ideia) {
            return $response->withJson($ideia->apoios->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute("apoio_id");
        $apoio = Apoio::find($id);
        if($apoio) {
            return $response->withJson($apoio->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Apoio not found'
            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute("apoio_id");
        $apoio = Apoio::find($id);
        if($apoio) {
            if($apoio->delete()) {
                return $response->withJson(array(
                    'message' => 'OK'
                ), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Apoio delete error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Apoio not found'
            ), 400);
        }
    }

}