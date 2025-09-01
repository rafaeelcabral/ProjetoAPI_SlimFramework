<?php

    //Verificação Padrão
    if (PHP_SAPI == 'cli-server') {
        // To help the built-in PHP dev server, check if the request was actually for
        // something which should probably be served as a static file
        $url  = parse_url($_SERVER['REQUEST_URI']);
        $file = __DIR__ . $url['path'];
        if (is_file($file)) {
            return false;
        }
    }

    //Carregando o Autoload do Composer
    require __DIR__ . '/../vendor/autoload.php';

    //Iniciando a Sessão
    session_start();

    //Instanciando o App
    $settings = require __DIR__ . '/../src/settings.php';
    $app = new \Slim\App($settings);

    //Dependências($container)
    require __DIR__ . '/../src/dependencies.php';

    //Middlewares
    require __DIR__ . '/../src/middleware.php';

    //Rotas
    require __DIR__ . '/../src/routes.php';

    //Run app
    $app->run();

?>
