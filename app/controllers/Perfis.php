<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Perfil;

class Perfis {

    public function create(Request $request, Response $response) {

        $data = $request->getParsedBody();
        
        $perfil = new Perfil();
        $perfil->no_perfil = $data['no_perfil'];
        $perfil->de_perfil = $data['de_perfil'];
        
        if($perfil->save()) {
            return $response->withJson($perfil->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Perfil create error'
            ), 400);
        }
    }

    public function list(Request $request, Response $response) {
        $perfis = Perfil::all();
        return $response->withJson($perfis->toArray(), 200);
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $perfil = Perfil::find($id);
        if($perfil) {
            return $response->withJson($perfil->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Perfil not found'
            ), 400);
        }
    }

    public function update(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $perfil = Perfil::find($id);

        if($perfil) {
            $perfil->no_perfil = $data['no_perfil'];
            $perfil->de_perfil = $data['de_perfil'];
            if($perfil->save()) {
                return $response->withJson($perfil->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Perfil update error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Perfil not found'
            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $perfil = Perfil::find($id);
        if($perfil) {
            if($perfil->delete()) {
                return $response->withJson(array(
                    'message' => 'OK'
                ), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Error while delete perfil'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Perfil not found'
            ), 400);
        }
    }

}