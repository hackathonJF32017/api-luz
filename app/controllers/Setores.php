<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Models\Setor;

class Setores {

    public function create(Request $request, Response $response) {

        $data = $request->getParsedBody();

        $setor = new Setor();
        $setor->no_setor = $data['no_setor'];
        $setor->de_setor = $data['de_setor'];

        if ($setor->save()) {
            return $response->withJson($setor->toArray(), 200);
        } else {
            return $response->withJson(array(
                        'error' => '000',
                        'message' => 'Setor create error'
                            ), 400);
        }
        }

        public function list(Request $request, Response $response) {
        $setores = Setor::all();
        return $response->withJson($setores->toArray(), 200);
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $setor = Setor::find($id);
        if ($setor) {
            return $response->withJson($setor->toArray(), 200);
        } else {
            return $response->withJson(array(
                        'error' => '000',
                        'message' => 'Setor not found'
                            ), 400);
        }
    }

    public function update(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $setor = Setor::find($id);

        if ($setor) {
            $setor->no_setor = $data['no_setor'];
            $setor->de_setor = $data['de_setor'];
            if ($setor->save()) {
                return $response->withJson($setor->toArray(), 200);
            } else {
                return $response->withJson(array(
                            'error' => '000',
                            'message' => 'Setor update error'
                                ), 400);
            }
        } else {
            return $response->withJson(array(
                        'error' => '000',
                        'message' => 'Setor not found'
                            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $setor = Setor::find($id);
        if ($setor) {
            if ($setor->delete()) {
                return $response->withJson(array(
                            'message' => 'OK'
                                ), 200);
            } else {
                return $response->withJson(array(
                            'error' => '000',
                            'message' => 'Error while delete setor'
                                ), 400);
            }
        } else {
            return $response->withJson(array(
                        'error' => '000',
                        'message' => 'Setor not found'
                            ), 400);
        }
    }

}
