<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Models\Usuario;
use Models\Perfil;
use Models\Setor;

class Usuarios {

    public function create(Request $request, Response $response) {

        $data = $request->getParsedBody();
        
        $usuario = new Usuario();
        $usuario->no_login = $data['no_login'];
        $usuario->no_nome = $data['no_nome'];
        $usuario->co_password = sha1($data['co_password']);
        $usuario->last_access = (new \DateTime())->format('Y-m-d H:i:s');
        $usuario->perfil()->associate(Perfil::find($data['co_perfil']));
        $usuario->setor()->associate(Setor::find($data['co_setor']));
        
        if($usuario->save()) {
            return $response->withJson($usuario->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Usuario create error'
            ), 400);
        }
    }

    public function list(Request $request, Response $response) {
        $usuarios = Usuario::all();
        return $response->withJson($usuarios->toArray(), 200);
    }

    public function get(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $usuario = Usuario::find($id);
        if($usuario) {
            return $response->withJson($usuario->toArray(), 200);
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Usuario not found'
            ), 400);
        }
    }

    public function update(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $usuario = Usuario::find($id);

        if($usuario) {
            $usuario->no_login = $data['no_login'];
            $usuario->no_nome = $data['no_nome'];
            $usuario->co_password = sha1($data['co_password']);
            $usuario->last_access = (new \DateTime())->format('Y-m-d H:i:s');
            $usuario->perfil()->associate(Perfil::find($data['co_perfil']));
            $usuario->setor()->associate(Setor::find($data['co_setor']));
            if($usuario->save()) {
                return $response->withJson($usuario->toArray(), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Usuario update error'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Usuario not found'
            ), 400);
        }
    }

    public function remove(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        $usuario = Usuario::find($id);
        if($usuario) {
            if($usuario->delete()) {
                return $response->withJson(array(
                    'message' => 'OK'
                ), 200);
            } else {
                return $response->withJson(array(
                    'error' => '000',
                    'message' => 'Error while delete usuario'
                ), 400);
            }
        } else {
            return $response->withJson(array(
                'error' => '000',
                'message' => 'Usuario not found'
            ), 400);
        }
    }

}