# e-goi

Esse repositório tem como única e exclusiva finalidade ser de caráter classificatório no processo seletivo da **e-goi**. Não há qualquer objetivo monetário ou acadêmico nessa aplicação.

## Sumário

1. [Sobre o repositório](#sobre-o-repositório).
2. [Dependências](#dependências).
3. [Testes unitários](#testes-unitários).
4. [Endpoints](#endpoints).
5. [Website](#website).

### Sobre o repositório
Aqui você encontrará uma pequena *app* com um *CRUD* **básico** para manipular categorias.

Essas categorias são armanezadas em um arquivo [.json](app/data/storage/categories.json).

### Dependências
Toda aplicação e seus respectivos testes são executados através do [Docker/Podman](./container/php/Dockerfile).

> NA: Eu, Marcio, uso o Podman. A versão atual no qual eu fiz esse teste é a `podman version 2.1.1`.

### Testes unitários
É possível encontrar alguns testes básicos para a aplicação funcionar conforme o esperado nos cenários mais corriqueiros.

O *coverage* dos testes pode ser encontrado dentro da pasta [public](./app/public/coverage/index.html).

Se preferir, pode executar os testes você mesmo com o comando `./bin/tests` :blush:

```shell
$ user@egoi: ll
drwxr-xr-x.  2 user user   4096 Oct  1 00:00 bin
-rw-r--r--.  1 user user   1078 Oct  1 00:00 composer.json
-rw-r--r--.  1 user user 119362 Oct  1 00:00 composer.lock
drwxr-xr-x.  3 user user   4096 Oct  1 00:00 config
drwxr-xr-x.  4 user user   4096 Oct  1 00:00 data
drwxr-xr-x.  4 user user   4096 Oct  1 00:00 module
drwxr-xr-x.  7 user user   4096 Oct  1 00:00 public
drwxr-xr-x. 19 user user   4096 Oct  1 00:00 vendor

$ user@egoi: ./bin/tests
```

### Endpoints
Se quiser ir direto aos endpoints, uma sugestão é o [POSTMAN](https://www.getpostman.com/collections/d5d25ca67605c32fedda).

Não tem o POSTMAN instalado? Não faz mal. Deixo o curl de cada endpoint.

**Criar uma categoria**
```
curl --location --request POST 'http://localhost:8080/category' \
--header 'x-cid: input-894fe4c4-e405-4c47-b54f-cb6dc640e108' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Category Name"
}'
```
**Listar todas as categorias**
```
curl --location --request GET 'http://localhost:8080/category?offset=1' \
--header 'x-cid: input-04c1b93c-c511-4e5b-84da-554f3599af42'
```
**Buscar apenas 1 categoria**
```
curl --location --request GET 'http://localhost:8080/category/1' \
--header 'x-cid: input-826266dd-2dc8-4a0e-91cd-27865f2a69ae'
```
**Atualizar o nome da categoria**
```
curl --location --request PATCH 'http://localhost:8080/category/1' \
--header 'x-cid: input-540a6d54-10cc-42e7-b3d5-9ec564977d1e' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "New name"
}'
```
**Deletar apenas 1 categoria**
```
curl --location --request DELETE 'http://localhost:8080/category/1' \
--header 'x-cid: input-9d3ea834-eeff-41d8-bd79-6b7312cbbf89'
```

### Website
Acessar via browser e testar a *app*, para isso é preciso subir a aplicação via docker:
```shell
$ user@egoi: ll
drwxr-xr-x. 8 user user 4096 Oct  1 00:00 app
drwxr-xr-x. 3 user user 4096 Oct  1 00:00 container
-rw-rw-r--. 1 user user 3511 Oct  1 00:00 README.md

$ user@egoi: ./container/up
```