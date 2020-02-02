# Setup utilizado

-   Wamp 3.2.0
-   PHP 7.2.10
-   MySQL 8.0.18
-   Laravel 6.13.1
-   Composer 1.9.1
-   Windows 10

# Run

Para rodar a aplicação será necessário as seguintes tecnologias: PHP, Composer e BD MySQL. Em seguida crie o arquivo .env a partir do .env.example e coloque os dados do seu BD:

-   `cd .\backend-challenge`

-   `composer install`

-   `php artisan migrate`

-   `php artisan db:seed`

-   `php artisan serve`

# End-points

### Login

Pegue um email gerado pela seed no BD para acessar este end-point. A senha sempre será 654321 para os e-mails gerados.

| End-Point                 | Descrição       |
| :------------------------ | :-------------- |
| `/api/auth/login` **GET** | Retorna {token} |

`/api/auth/login` **GET**

Body

```shell
{
	"email": "qdoyle@davis.biz",
	"password": 654321
}
```

Response

```shell
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsdW1lbi1qd3QiLCJzdWIiOjIsImlhdCI6MTU4MDY4NDcyMCwiZXhwIjoxNTgwNjg4MzIwfQ.OaqtH-GTpJeRIFflybd8ia_KOD3JurPxhUfM3geqfDE"
}
```

### Cadastro de usuário

| End-Point                     | Descrição           |
| :---------------------------- | :------------------ |
| `/api/users/register` **GET** | Cadastro de usuário |

`/api/users/register` **GET**

Body

```shell
{
	"name" : "Teste 123",
	"email": "testes@teste.com",
	"password": "654321"
}
```

Response

```shell
{
    "name": "Teste 123",
    "email": "testes@teste.com",
    "updated_at": "2020-02-02 17:47:06",
    "created_at": "2020-02-02 17:47:06",
    "id": 11
}
```

### Colors

| End-Point                       | Descrição              |
| :------------------------------ | :--------------------- |
| `/api/colors/list` **GET**      | Mostra todas as cores  |
| `/api/colors/register` **POST** | Cadastra uma cor       |
| `/api/colors/update` **PUT**    | Atualiza uma cor       |
| `/api/colors/delete` **DELETE** | Deleta uma cor         |

`/api/colors/list` **GET**

Header

```shell
Authorization: Bearer {token}
```

Response

```shell
[
    {
        "id": 1,
        "titulo_produto": "numquam",
        "descricao_produto": "Dignissimos quia nemo nihil et. Molestias quo sit beatae et ullam totam tempore quis. Id excepturi in nostrum.",
        "quantidade_produto": 64,
        "cores_array": "[2,10,3,3]",
        "nome_cor": "MediumSeaGreen",
        "hex_code_cor": "#05dfeb",
        "nome_usuario": "Caesar Kiehn",
        "email_usuario": "uhermiston@example.com"
    },
    .
    .
    .
]
```

`/api/colors/register` **POST**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
	"nome_cor": "Azul",
	"hex_code_cor": "#5442f5"
}
```

Response

```shell
{
    "msg": "Produto registrado com sucesso"
}
```

`/api/colors/update` **PUT**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
    "id": 1,
	"nome_cor": "Azul",
	"hex_code_cor": "#5442f5"
}
```

Response

```shell
{
    "msg": "Produto atualizado com sucesso"
}
```

`/api/colors/delete` **DELETE**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
    "id": 1
}
```

Response

```shell
{
    "msg": "Produto deletado com sucesso"
}
```

### Products

| End-Point                         | Descrição                |
| :-------------------------------- | :----------------------- |
| `/api/products/list` **GET**      | Mostra todos os produtos |
| `/api/products/register` **POST** | Cadastra um produto      |
| `/api/products/update` **PUT**    | Atualiza um produto      |
| `/api/products/delete` **DELETE** | Deleta um produto        |

`/api/products/list` **GET**

Header

```shell
Authorization: Bearer {token}
```

Response

```shell
[
    {
        "id": 1,
        "nome_cor": "MediumPurple",
        "hex_code_cor": "#1cf7ba",
        "created_at": "2020-02-02 19:54:54",
        "updated_at": "2020-02-02 19:54:54"
    },
    . 
    .
    .
]
```

`/api/products/register` **POST**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
	"titulo": "Titulo 3",
	"descricao": "Descrição 3",
	"quantidade": 44,
	"cores_array": [3,2,1],
	"color_id": 1
}
```

Response

```shell
{
    "msg": "Cor registrada com sucesso"
}
```

`/api/products/update` **PUT**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
    "id": 1,
	"titulo": "Titulo 3",
	"descricao": "Descrição 3",
	"quantidade": 44,
	"cores_array": [3,2,1],
	"color_id": 1
}
```

Response

```shell
{
    "msg": "Cor atualizada com sucesso"
}
```

`/api/products/delete` **DELETE**

Header

```shell
Authorization: Bearer {token}
```

Body

```shell
{
    "id": 1
}
```

Response

```shell
{
    "msg": "Cor deletada com sucesso"
}
```
