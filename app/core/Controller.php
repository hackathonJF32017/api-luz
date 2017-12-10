<?php

class Controller {

    public static function json($data) {
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function getRootPath() {
        return __DIR__ . '/../../';
    }

    public static function run() {
        $class = @get_called_class();
        if(isset($class) && $class != '' && $class != 'Controller') {
            $args     = func_get_args();
            $reflect  = new ReflectionClass($class);
            $instance = $reflect->newInstanceArgs($args);
        }
    }

    public static function runMethod($method) {
        $class = @get_called_class();
        if(isset($class) && $class != '' && $class != 'Controller') {
            return function () use ($class, $method) {
                $args = func_get_args();
                $reflect = new ReflectionClass($class);
                $instance = $reflect->newInstance();
                call_user_func_array(array($instance, $method), $args);
            };
        }
    }
}