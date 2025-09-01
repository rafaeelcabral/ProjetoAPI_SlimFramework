<?php

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Models\Produto;

    $app->group('/api/v1/produtos', function() {

        //Listar
        $this->get('/get[/{id}]', function(Request $request, Response $response) {

            $jwt = $request->getAttribute("jwt");

            if($request->getAttribute('id') != null) {

                $produto = Produto::findOrFail($request->getAttribute('id'));

                return $response->withJson($produto);

            } else {

                $lista_de_produtos = Produto::get();

                return $response->withJson($lista_de_produtos);

            }

        });

        //Inserir
        $this->post('/add', function(Request $request, Response $response) {

            $jwt = $request->getAttribute("jwt");

            $dados = $request->getParsedBody();

            Produto::create($dados);

            return $response->Write('Produto registrado com Sucesso !!!');

        });

        //Atualizar
        $this->put('/update/{id}', function(Request $request, Response $response) {

            $jwt = $request->getAttribute("jwt");

            $dados = $request->getParsedBody();

            $produto = Produto::findOrFail($request->getAttribute('id'));

            $produto->update($dados);

            return $response->Write('Produto atualizado com Sucesso !!!');

        });

        //Remover
        $this->delete('/delete/{id}', function(Request $request, Response $response) {

            $jwt = $request->getAttribute("jwt");

            $produto = Produto::findOrFail($request->getAttribute('id'));

            $produto->delete();

            return $response->Write('Produto removido com Sucesso !!!');

        });

    })->add($jwtMiddleware);

?>