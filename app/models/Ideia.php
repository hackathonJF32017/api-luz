<?php

namespace Models;

class Ideia extends \Model {

    protected $table = 'luztb_004_ideias';
    public $timestamps = false;
    protected $primaryKey = 'co_ideia';

    protected $appends = ['totalApoios'];

    public function usuario() {
        return $this->belongsTo('Models\Usuario', 'co_usuario');
    }

    public function setor() {
        return $this->belongsTo('Models\Setor', 'co_setor');
    }

    public function comentarios() {
        return $this->hasMany('Models\Comentario', 'co_ideia');
    }

    public function apoios() {
        return $this->hasMany('Models\Apoio', 'co_ideia')->where('co_comentario', 0);
    }

    public function usuarioResposta() {
        return $this->belongsTo('Models\Usuario', 'co_usuario_resposta');
    }

    public function getTotalApoiosAttribute() {
        return $this->apoios->count();
    }

}