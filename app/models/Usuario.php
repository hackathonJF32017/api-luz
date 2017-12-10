<?php

namespace Models;

class Usuario extends \Model {
    
    protected $table = "luztb_001_usuario";
    public $timestamps = false;
    protected $primaryKey = 'co_usuario';

    public function setor() {
        return $this->belongsTo('Models\Setor', 'co_setor');
    }

    public function perfil() {
        return $this->belongsTo('Models\Perfil', 'co_perfil');
    }

}