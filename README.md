## Documentação

## Ambiente
- PHP - 7.4 ou superior (Prefencialmente 8);
- Base de dados MySql;

## Tecnologias utilizadas
Laravel 8
Laravel Orion - Criação de api Rest
Laravel UI
Laravel Sanctum - Auth


## Autenticação

Rotas view -  CSRF 
Rotas API - Sanctum api-key

## Instalação 

Clone o repositorio para o servidor de preferencia;

Execute os comandos:
- Composer install;
- php artisan key:generate;
- php artisan migrate;

Para utilizar Rest é necessario gerar um token-api de longa duração:
Após cadastrar um novo usuário;
abra o terminal: 
- php artisan tinker ;

$user = User::first();

$user->createToken('api-access');

Salve o campo

+plainTextToken: "1|d0DNHRTLfn9Fp87qYWenEYbF9gTwns5ycVeIchOb",

- 1|d0DNHRTLfn9Fp87qYWenEYbF9gTwns5ycVeIchOb este é o bearer token que deve ser enviado para as rotas de API

## Rotas API rest (autenticadas para acesso externo via Bearer token)

- GET|HEAD  api/chamados        | chamados.index
-  POST     api/chamados        | chamados.store
-  POST     api/chamados/batch  | chamados.batchStore 
-  PATCH    api/chamados/batch  | chamados.batchUpdate
-  DELETE   api/chamados/batch  | chamados.batchDestroy 
-  POST     api/chamados/search | chamados.search

- GET|HEAD  api/chamados/{chamado}     | chamados.show
- PUT|PATCH api/chamados/{chamado}     | chamados.update 
- DELETE    api/chamados/{chamado}     | chamados.destroy 

- GET|HEAD  api/user                   

- GET|HEAD  | api/vendedores 
- POST      | api/vendedores             | vendedores.store 
- POST      | api/vendedores/batch       | vendedores.batchStore
- PATCH     | api/vendedores/batch       | vendedores.batchUpdate
- DELETE    | api/vendedores/batch       | vendedores.batchDestroy
- POST      | api/vendedores/search      | vendedores.search          

GET|HEAD  | api/vendedores/{vendedore} | vendedores.show 
PUT|PATCH | api/vendedores/{vendedore} | vendedores.update
DELETE    | api/vendedores/{vendedore} | vendedores.destroy 

## Crud Vendedor

## Crud Cadastro

## Soluções

### Chamados Atrasados

Existe uma rotina no scheduller do Laravel verificando a cada 5 minutos os chamados abertos e quando foram criados, caso a data de criação seja maior que 24hrs o status do chamado é alterado para Atrasado;

### Chamados distribuidos para o consultor com menos chamados em aberto



## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
