<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Ideia;
use Models\Setor;
use Models\Usuario;

class Ideias {

    public function create(Request $request, Response $response) {

        $data = $request->getParsedBody();
        $token = \Crypt::decrypt($_SERVER['HTTP_APP_TOKEN']);

        $user  = Usuario::find($token['id']);
        $setor = Setor::find($data['co_setor']);

        $ideia = new Ideia();
        $ideia->usuario()->associate($user);
        $ideia->setor()->associate($setor);
        $ideia->de_ideia = $data['de_ideia'];

        if($ideia->save()) {
            return $response->withJson($ideia->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia create error'
            ), 400);
        }

    }

    public function list(Request $request, Response $response) {
        $ideias = Ideia::all();
        $ideias = $ideias->toArray();

        usort($ideias, function($a, $b) {
            if($a['totalApoios'] < $b['totalApoios']) {
                return 1;
            } elseif ($a['totalApoios'] == $b['totalApoios']) {
                return 0;
            } elseif ($a['totalApoios'] > $b['totalApoios']) {
                return -1;
            }
        });

        return $response->withJson($ideias, 200);
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $ideia = Ideia::find($id);

        $setor = $ideia->setor;
        $usuario = $ideia->usuario;
        $usuarioResposta = $ideia->usuarioResposta;
        $comentarios = $ideia->comentarios->toArray();

        usort($comentarios, function($a, $b) {
            if($a['totalApoios'] < $b['totalApoios']) {
                return 1;
            } elseif ($a['totalApoios'] == $b['totalApoios']) {
                return 0;
            } elseif ($a['totalApoios'] > $b['totalApoios']) {
                return -1;
            }
        });

        if($ideia) {
            $ideia = $ideia->toArray();
            $ideia['setor'] = $setor;
            $ideia['usuario'] = $usuario;
            $ideia['usuario_resposta'] = $usuarioResposta;
            $ideia['comentarios'] = $comentarios;
            return $response->withJson($ideia, 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function update(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $ideia = Ideia::find($id);

        if($ideia) {

            $setor = Setor::find($data['co_setor']);
            $ideia->setor()->associate($setor);
            $ideia->de_ideia = $data['de_ideia'];

            if($ideia->save()) {
                return $response->withJson($ideia->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Ideia update error'
                ), 400);
            }

        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $ideia = Ideia::find($id);
        if($ideia) {
            if($ideia->delete()) {
                return $response->withJson(array(
                    'message' => 'OK'
                ), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Error while delete ideia'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

    public function resposta(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $ideia = Ideia::find($id);

        if($ideia) {

            $token = \Crypt::decrypt($_SERVER['HTTP_APP_TOKEN']);
            $user  = Usuario::find($token['id']);

            $ideia->usuarioResposta()->associate($user);
            $ideia->de_resposta = $data['de_resposta'];

            if($ideia->save()) {
                return $response->withJson($ideia->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Ideia update error'
                ), 400);
            }

        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Ideia not found'
            ), 400);
        }
    }

}