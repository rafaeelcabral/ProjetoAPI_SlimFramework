# API SlimFramework - CRUD de Produtos

Este é um projeto de API feito com SlimFramework (v3) para gerenciar
produtos. É um projeto simples para estudo, mas funcional, usando PHP e
Eloquent ORM (Illuminate/Database).

A API possui autenticação via JWT, usando a biblioteca Firebase PHP-JWT.
Só quem tiver um token válido consegue acessar as rotas protegidas.


## 💻 Tecnologias usadas

-   PHP 8.x
-   SlimFramework 3
-   Firebase PHP-JWT
-   Illuminate/Database (Eloquent ORM)
-   MySQL (ou outro banco compatível com Eloquent)


## 📦 Funcionalidades

-   CRUD completo de produtos
-   Autenticação via token JWT
-   Apenas usuários autenticados podem acessar as rotas da API


## 🔑 Autenticação

Para acessar as rotas de produtos, você precisa de um token JWT.


#### 1️⃣ Gerar o token

Faça um cadastro de usuário (com email e senha) no banco.

Use o Postman para enviar um **POST** para a rota `/gerar_token` com:

``` json
{
    "email": "seu_email@exemplo.com",
    "senha": "sua_senha"
}
```

A API vai retornar um JSON com o token:

``` json
{
    "token": "seu_token_gerado_aqui"
}
```

#### 2️⃣ Usar o token nas rotas

Nas rotas protegidas (CRUD de produtos), você deve enviar o token no
header Authorization do Postman:

    Authorization: Bearer SEU_TOKEN_AQUI


## 🚀 Rotas da API

**Base:** `/api/v1/produtos`

| Método | Rota             | Descrição |
|-------|-------------------|-----------|
| GET   | `/get[/{id}]`     | Listar produtos. Se não passar `id`, retorna todos. Se passar `id`, retorna apenas o produto específico. |
| POST  | `/add`            | Adicionar novo produto. Precisa passar: `titulo`, `descricao`, `preco` e `fabricante`. |
| PUT   | `/update/{id}`    | Atualizar produto existente. Precisa passar `id` na URL e os campos que deseja atualizar. |
| DELETE| `/delete/{id}`    | Remover produto. Precisa passar `id` na URL. |



## ⚙️ Observações

-   Senhas são armazenadas com **MD5** (não é seguro para produção, só
    para estudo).
-   A API foi feita com foco em estudo e aprendizado de Slim, JWT e
    Eloquent.
-   Para gerar token, você precisa estar cadastrado no banco de
    usuários.
