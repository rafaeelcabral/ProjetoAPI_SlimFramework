<?php

    //Verificação Padrão
    if (PHP_SAPI != 'cli') {
        exit('Rodar via CLI');
    }

    //Carregando o Autoload do Composer
    require __DIR__ . '/vendor/autoload.php';

    //Instanciando o App
    $settings = require __DIR__ . '/src/settings.php';
    $app = new \Slim\App($settings);

    //Dependências($container)
    require __DIR__ . '/src/dependencies.php';

    //--------------------------------------------------------------

    $db = $container->get('db');

    //Criar Tabela
    $db->schema()->dropIfExists('produtos');
    $db->schema()->create('produtos', function($table){
        $table->increments('id');
        $table->string('titulo', 100);
        $table->text('descricao');
        $table->decimal('preco', 11, 2);
        $table->string('fabricante', 60);
        $table->timestamps();
    });

    //Inserindo Registros
    $db->table('produtos')->insert($adicionar_produto = [

        'titulo' => 'iPhone 14 Pro',

        'descricao' => 'Smartphone Apple com tela Super Retina XDR de 6.1", 128GB de armazenamento, câmera tripla de 48MP, iOS 16.',

        'preco' => 6999.90,

        'fabricante' => 'Apple',

        'created_at' => '2025-08-29',

        'updated_at' => '2025-08-29' 

    ]);

    $db->table('produtos')->insert($adicionar_produto = [

        'titulo' => 'Dell Inspiron 15 3000',

        'descricao' => 'Notebook com processador Intel Core i5 12ª geração, 8GB RAM, SSD 512GB, tela Full HD 15.6", Windows 11.',

        'preco' => 3899.00,

        'fabricante' => 'Dell',
        
        'created_at' => '2025-08-29',

        'updated_at' => '2025-08-29' 

    ]);

?>
