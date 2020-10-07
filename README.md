# e-goi

Esse repositório tem como única e exclusiva finalidade ser de caráter classificatório no processo seletivo da **e-goi**. Não há qualquer objetivo monetário ou acadêmico nessa aplicação.

## Sumário

1. [Sobre o repositório](#sobre-o-repositório).
2. [Dependências](#dependências).
3. [Testes unitários](#testes-unitários).
4. [Endpoints](#endpoints).
5. [Mãos na massa!](#mãos-na-massa).

### Sobre o repositório
Aqui você encontrará uma pequena *app* com um *CRUD* **básico** para manipular categorias.

Essas categorias são armanezadas em um arquivo [.json](app/api/data/storage/categories.json).

### Dependências
Toda aplicação e seus respectivos testes são executados através do Docker. A versão no qual eu me baseei é a `Docker version 19.03.13`.

### Testes unitários
Apenas o *backend* ([api](app/api)) contém testes unitários. Esses testes são feitos com o **PHPUnit**.

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

### Mãos na massa!
O deploy de toda aplicação (dev, apenas) é feito via *make*:
```shell
$ user@egoi: make --version
GNU Make 4.2.1
Built for x86_64-redhat-linux-gnu
Copyright (C) 1988-2016 Free Software Foundation, Inc.
License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.
```

O primeiro passo é gerar as imagens.

> Daqui em diante é preciso estar na pasta raiz do projeto, claro.

```shell
$ user@egoi: make build
```

Após alguns minutos de espera, vamos disponibilizar as apps para consumo.

```shell
$ user@egoi: make up
```

Pronto, a aplicação já está disponível. O resultado final da app (Angular9 consumindo a API via ZF2) pode ser encontrado através da URL http://localhost:4242/.

A API pode ser acessada via http://localhost:8080/category.

Os testes da API são executados com o `make`, também.

```shell
$ user@egoi: make test
```

Caso queira pausar os containers e remover as imagens, execute os seguintes comandos:
```shell
$ user@egoi: make stop
$ user@egoi: make remove
```