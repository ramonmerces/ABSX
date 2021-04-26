## Documentação

## Ambiente
- PHP - 7.4 ou superior (Prefencialmente 8);
- Base de dados MySql;

## Tecnologias utilizadas
- Laravel 8
- Laravel Orion - Criação de api Rest
- Laravel UI
- Laravel Sanctum - Auth


## Autenticação

Rotas view -  CSRF 
Rotas API - Sanctum api-key

## Instalação 

Clone o repositorio para o servidor de preferencia;

Execute os comandos:
```bash
Composer install;
```
```bash
php artisan key:generate;
```
```bash
php artisan migrate;
```

- Para utilizar Rest é necessario gerar um token-api de longa duração:
- Após cadastrar um novo usuário;
- abra o bash: 

```bash
php artisan tinker ;
```
```bash
$user = User::first();
```
```bash
$user->createToken('api-access');
```
-Salve o campo:

```bash
+plainTextToken: "1|d0DNHRTLfn9Fp87qYWenEYbF9gTwns5ycVeIchOb",
```
- 1|d0DNHRTLfn9Fp87qYWenEYbF9gTwns5ycVeIchOb 
- este é o bearer token que deve ser enviado para as rotas de API

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

- GET|HEAD  | api/vendedores/{vendedore} | vendedores.show 
- PUT|PATCH | api/vendedores/{vendedore} | vendedores.update
- DELETE    | api/vendedores/{vendedore} | vendedores.destroy 

## Crud Vendedor

- [Crud vendedor](http://ramonmerces.xyz/cadastro-vendedor)

## Crud Chamado

- [Crud Chamado](http://ramonmerces.xyz/crud-chamado)

## Soluções

Ao fazer [login](http://ramonmerces.xyz/login) 
- Usuario; joao.absx@mailinator.com
- Senha: absx1234

Existem 3 cards representam os cruds de chamados e vendedores e outro apresenta a visão sem auth para cadastro externo de chamados.
Para visualizar os comando no scheduller execute o comando

```bash
php artisan schedule:list
```
### Chamados Atrasados

Existe uma rotina no scheduller do Laravel verificando a cada 5 minutos os chamados abertos e quando foram criados, caso a data de criação seja maior que 24hrs o status do chamado é alterado para Atrasado.
O tempo pode ser modificado de acordo com a sensibilidade deste atributo:

### Chamados distribuidos para o consultor com menor quantidade de chamados Abertos

Ao criar um novo chamado atribui-se a ao consultor com menos chamados em aberto.