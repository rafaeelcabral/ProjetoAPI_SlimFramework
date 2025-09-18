<?php

    $app->group('/api/v1/produtos', function() {

        //Listar
        $this->get('/get[/{id}]', 'App\Controllers\ProdutoController:listar');

        //Inserir
        $this->post('/add', 'App\Controllers\ProdutoController:inserir');

        //Atualizar
        $this->put('/update/{id}', 'App\Controllers\ProdutoController:atualizar');

        //Remover
        $this->delete('/delete/{id}', 'App\Controllers\ProdutoController:remover');

    })->add($jwtMiddleware);

?>