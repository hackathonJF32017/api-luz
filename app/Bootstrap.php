<?php

use \Slim\App as Slim;
use Illuminate\Database\Capsule\Manager as Capsule;

class App extends Slim {
    
    private $route;

    public function bootEloquent() {

        $capsule = new Capsule;

        $database = require(__DIR__ . '/config/database.php');

        $capsule->addConnection($database);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }

    public function bootSlim() {
        parent::__construct(array(
            'settings' => array(
                'displayErrorDetails' => true
            )
        ));
    }

    public function bootRouter(){
        $routes = require(__DIR__ . '/Routes.php');
        $routes($this);
    }

    public function boot(){
        $this->bootEloquent();
        $this->bootSlim();
        $this->bootRouter();
    }
}