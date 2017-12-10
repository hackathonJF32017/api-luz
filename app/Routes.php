<?php

return function($route) {

    $route->group('/auth', function() use ($route) {
        $route->post('/login', 'Controllers\Auth:login');
        $route->post('/register', 'Controllers\Auth:create');
    });

    $route->get('/', function($resource, $response) {
    
    });

    // SETORES INICIO
    $route->get('/setores', 'Controllers\Setores:list')->add(new \Middlewares\Auth());
    $route->post('/setores', 'Controllers\Setores:create')->add(new \Middlewares\Auth());
    $route->group('/setores', function() use ($route) {
        $route->get('/{id}', 'Controllers\Setores:get');
        $route->post('/{id}', 'Controllers\Setores:update');
        $route->delete('/{id}', 'Controllers\Setores:remove');
    })->add(new \Middlewares\Auth());
    // SETORES FINAL

    // PERFIL INICIO
    $route->get('/perfis', 'Controllers\Perfis:list')->add(new \Middlewares\Auth());
    $route->post('/perfis', 'Controllers\Perfis:create')->add(new \Middlewares\Auth());
    $route->group('/perfis', function() use ($route) {
        $route->get('/{id}', 'Controllers\Perfis:get');
        $route->post('/{id}', 'Controllers\Perfis:update');
        $route->delete('/{id}', 'Controllers\Perfis:remove');
    })->add(new \Middlewares\Auth());
    // PERFIL FINAL

    // USUARIO INICIO
    $route->get('/usuarios', 'Controllers\Usuarios:list')->add(new \Middlewares\Auth());
    $route->post('/usuarios', 'Controllers\Usuarios:create')->add(new \Middlewares\Auth());
    $route->group('/usuarios', function() use ($route) {
        $route->get('/{id}', 'Controllers\Usuarios:get');
        $route->post('/{id}', 'Controllers\Usuarios:update');
        $route->delete('/{id}', 'Controllers\Usuarios:remove');
    })->add(new \Middlewares\Auth());
    // USUARIO FINAL

    // IDEIA INICIO
    $route->get('/ideias', 'Controllers\Ideias:list')->add(new \Middlewares\Auth());
    $route->post('/ideias', 'Controllers\Ideias:create')->add(new \Middlewares\Auth());
    $route->group('/ideias', function() use ($route) {
        $route->get('/{id}', 'Controllers\Ideias:get');
        $route->post('/{id}', 'Controllers\Ideias:update');
        $route->delete('/{id}', 'Controllers\Ideias:remove');

        $route->post('/{id}/resposta', 'Controllers\Ideias:resposta');

        $route->get('/{id}/comentarios', 'Controllers\Comentarios:list');
        $route->post('/{id}/comentarios', 'Controllers\Comentarios:create');
        $route->group('/{id}/comentarios', function () use ($route) {
            
            $route->get('/{comentario_id}', 'Controllers\Comentarios:get');
            $route->post('/{comentario_id}', 'Controllers\Comentarios:update');
            $route->delete('/{comentario_id}', 'Controllers\Comentarios:remove');

            $route->get('/{comentario_id}/apoios', 'Controllers\Apoios:list');
            $route->post('/{comentario_id}/apoios', 'Controllers\Apoios:create');

            $route->group('/{comentario_id}/apoios', function() use ($route) {
                $route->get('/{apoio_id}', 'Controllers\Apoios:get');
                $route->delete('/{apoio_id}', 'Controllers\Apoios:remove');
            });

        });

    })->add(new \Middlewares\Auth());
    // IDEIA FINAL

};