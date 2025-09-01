<?php

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Models\Usuario;
    use Firebase\JWT\JWT;

    $app->post('/api/get_token', function(Request $request, Response $response) {

        $dados = $request->getParsedBody();

        //-----------------------------------

        if($dados['email'] == '') {
            $email = null;
        } else {
            $email = $dados['email'];
        }

        if($dados['senha'] == '') {
            $senha = null;
        } else {
            $senha = $dados['senha'];
        }

        //-----------------------------------

        $usuario = Usuario::where('email', $email)->first();

        if($email != null && $senha != null && $usuario->senha == md5($senha)) {
            
            //Gerar Token usando biblioteca Firebase do PHP
            $secret_key = 'QZ4Cu5Jal2NqAOdgRJAdhieQzh2Kwpjq';
            
            $payload = [
                'iss' => 'meu-sistema',   // quem emitiu
                'aud' => 'meu-app',       // para quem serve
                'iat' => time(),          // criado em
                'exp' => time() + 3600,   // expira em 1h
                'data' => [
                    'id'    => $usuario->id,
                    'email' => $usuario->email
                ]
            ];

            $chave_de_acesso = JWT::encode($payload, $secret_key, 'HS256');

            return $response->withJson([
                'token' => $chave_de_acesso 
            ]);

        } else {

            return $response->withJson([
                'status' => 'erro'
            ]);

        }

    });

?>