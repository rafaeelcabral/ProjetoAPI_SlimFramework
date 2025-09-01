<?php

    namespace App\Models;

    class Produto extends \Illuminate\Database\Eloquent\Model {

        protected $fillable = [
            'titulo',
            'descricao',
            'preco',
            'created_at',
            'updated_at'
        ];
        
    }

?>