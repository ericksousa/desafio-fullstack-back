<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre

Este é um serviço de backend, apenas com API, para realizar o registro/autenticação de usuários, cadastro de categorias e produtos.

## Comandos úteis

### Instala as dependências do Projeto

-   docker exec -it app composer install
-   docker compose run --rm npm install

### Roda as migrations

-   docker exec -it app php artisan migrate

### Gera a chave criptográfica do Laravel:

-   docker exec -it app php artisan key:generate

### Roda o projeto

-   docker-compose up -d

    > A partir daqui o projeto já estará rodando na porta 8080.

### Cria um novo usuário via comando artisan:

-   docker exec -it app php artisan app:create-user

## Rotas disponíveis

#### POST - /api/register

Exemplo de payload:

```json
{
    "name": "Fulano de Tal",
    "email": "fulano@email.com",
    "password": "123456",
    "password_confirmation": "123456"
}
```

#### POST - /api/login

Exemplo de payload:

```json
{
    "email": "fulano@email.com",
    "password": "123456"
}
```

#### POST - /api/category

Exemplo de payload:

```json
{
    "name": "Informática"
}
```

#### GET - /api/category

#### POST - /api/product

Exemplo de payload:

```json
{
    "name": "Notebook Lenovo",
    "price": 2500,
    "category_id": 1
}
```

#### GET - /api/product
