<?php

namespace Models;

class Apoio extends \Model {

    protected $table = 'luztb_006_apoio';
    public $timestamps = false;
    protected $primaryKey = 'co_apoio';

    public function ideia() {
        return $this->belongsTo('Models\Ideia', 'co_ideia');
    }

    public function comentario() {
        return $this->belongsTo('Models\Comentario', 'co_comentario');
    }

    public function usuario() {
        return $this->belongsTo('Models\Usuario', 'co_usuario');
    }

}