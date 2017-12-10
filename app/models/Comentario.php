<?php

namespace Models;

class Comentario extends \Model {

    protected $table = 'luztb_005_comentarios';
    public $timestamps = false;
    protected $primaryKey = 'co_comentario';

    protected $appends = ['totalApoios'];

    public function ideia() {
        return $this->belongsTo('Models\Ideia', 'co_ideia');
    }

    public function usuario() {
        return $this->belongsTo('Models\Usuario', 'co_usuario');
    }    

    public function apoios() {
        return $this->hasMany('Models\Apoio', 'co_comentario');
    }

    public function getTotalApoiosAttribute() {
        return $this->apoios->count();
    }

}