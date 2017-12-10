<?php

namespace Models;

class Ideia extends \Model {

    protected $table = 'luztb_004_ideias';
    public $timestamps = false;
    protected $primaryKey = 'co_ideia';

    public function usuario() {
        return $this->belongsTo('Models\Usuario', 'co_usuario');
    }

    public function setor() {
        return $this->belongsTo('Models\Setor', 'co_setor');
    }

    public function comentarios() {
        return $this->hasMany('Models\Comentario', 'co_ideia');
    }

    public function usuarioResposta() {
        return $this->belongsTo('Models\Usuario', 'co_usuario_resposta');
    }

}