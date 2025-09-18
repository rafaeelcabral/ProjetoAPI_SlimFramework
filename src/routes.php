<?php

    //Conectando com o Bando de Dados
    $container->get('db');

    //--------------------------------------------

    //Adicionando uma rota do tipo Options para liberar o CORS da nossa API
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    //--------------------------------------------

    //Rota de Interface
    $app->get('/', function($request, $response, $args) {
        return $this->renderer->render($response, 'index.phtml');
    });

    //Usuarios
    require __DIR__ . '/routes/get_token.php';

    //Produtos
    require __DIR__ . '/routes/produtos.php';

    //--------------------------------------------

    //Tratamento de erro da API;
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        $handler = $this->notFoundHandler;
        return $handler($request, $response);
    });

?>
