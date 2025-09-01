<?php

    //Atribuindo à variavel $jwtMiddleware uma Função anônima q será adicionada no grupo de rotas para verificar o Token do Usuário
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use Slim\Http\Request;
    use Slim\Http\Response;

    $jwtMiddleware = function (Request $request, Response $response, callable $next) {
        $secret_key = "QZ4Cu5Jal2NqAOdgRJAdhieQzh2Kwpjq";
        $authHeader = $request->getHeaderLine("Authorization");

        if (!$authHeader || !preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            return $response->withJson(["error" => "Token não fornecido"], 401);
        }

        $jwt = $matches[1];

        try {
            $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
            $request = $request->withAttribute("jwt", $decoded);
        } catch (Exception $e) {
            return $response->withJson(["error" => "Token inválido: " . $e->getMessage()], 401);
        }

        return $next($request, $response);
    };

    //--------------------------------------------------------------

    //Respondendo com configurações de Header
    $app->add(function ($req, $res, $next) {

        $response = $next($req, $res);

        return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
                
    });
    
?>