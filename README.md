
# Gosat Test

Este repositório trata-se de um teste realizado em Laravel para a empresa Gosat.

O teste consiste na utilização de uma API externa para consultar um CPF e verificar quais instituições e modalidades de empréstimo estão disponíveis para o CPF informado.

Após obter esse resultado, é necessário realizar uma segunda requisição a outro endpoint para receber a proposta propriamente dita, contendo informações sobre parcelas, juros e valores.

Como parte do teste, foi criada uma API própria capaz de receber as propostas, tratá-las e armazená-las em um banco de dados.
Após esse processo, deve ser possível retornar pelo menos 3 propostas ao cliente, classificadas em ordem de melhor benefício. Nesse caso, o critério de classificação é a menor taxa de juros, e em caso de empate, o valor disponível para empréstimo é utilizado como critério de desempate.

## Stack utilizada

- **Back-end:** Laravel
- **Database:** MySQL

## Pré-requisitos

Certifique-se de ter as seguintes dependências instaladas em sua máquina:
- PHP
- Composer
- Docker

## Referências 

* [Laravel Sail Documentation:](https://laravel.com/docs/sail)
* [MySQL Documentation:](https://dev.mysql.com/doc/)
* [Docker Documentation:](https://docs.docker.com/)

## Instalação
Copie o repositorio

```bash
git clone git@github.com:ViniciusRCampos/GosatTest.git
```
Acesse o Diretorio do projeto

```bash
cd GosatTest
```
instale as dependencias

```bash
composer install
```
Copiar o arquivo .env:

```bash
cp .env.example .env
```
Configure as variáveis de ambiente no arquivo .env.


Inicie os containers do projeto

```bash
./vendor/bin/sail up
```
Acesse o shell do Laravel Sail:

  ```bash
./vendor/bin/sail shell
```
Execute as migrations do banco de dados:

  ```bash
php artisan migrate
```

## Documentação da API

### Rotas disponiveis para importação no postman em routes/postman. 
Importe os arquivos no postman e as execute como desejar.

#### Busca as ofertas disponiveis

```http
  POST localhost:8080/api/
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `cpf` | `string` | **Obrigatório**. Cpf para solicitar as ofertas disponiveis |

#### Retorna as ofertas armezanadas no banco, só funciona após buscar alguma oferta

```http
  POST localhost:8080/api/offers
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `cpf`      | `string` | **Obrigatório**. Cpf para solicitar as ofertas disponiveis |

