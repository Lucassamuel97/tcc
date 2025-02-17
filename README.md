<a href="https://app.travis-ci.com/github/Lucassamuel97/tcc">
    <img src="https://app.travis-ci.com/Lucassamuel97/tcc.svg?branch=main" alt="build:started">
</a>

# TCC

Este repositório é destinado ao desenvolvimento do Trabalho de Conclusão de Curso (TCC) do curso de Tecnologia em Sistemas para Internet (UTFPR)

## Descrição

O objetivo do TCC é desenvolver uma aplicação web para o controle de manutenções preventivas de colheitadeiras e tratores agrícolas.

## Link para a monografia

Para acessar a documentação e monografia, utilize o link abaixo:

- [Monografia](https://tcc.tsi.pro.br/uploads/academic_activity/pdf/132/GP_COINT_2022_1_LUCAS_SAMUEL_PEREIRA_GODOY_MONOGRAFIA.pdf)

## Tecnologias

A aplicação será desenvolvida utilizando as seguintes tecnologias:

- [Laravel](https://laravel.com/)
- [Php](https://www.php.net/)
- [Bootstrap](https://getbootstrap.com/docs/4.6/)
- [mysql](https://www.mysql.com/)
- [JavaScript](https://www.javascript.com/)
- [HTML](https://html.com/)
- [CSS](https://www.w3.org/Style/CSS/)
- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)

## Instalação

Para instalar o projeto, siga os passos abaixo:

1. Clone o repositório:
    ```bash
    git clone https://github.com/Lucassamuel97/tcc.git
    ```
2. Acesse a pasta do projeto:
    ```bash
    cd tcc
    ```
3. Execute a instalação das dependências:
    ```bash
    composer install
    ```
4. Copie o arquivo de configuração do ambiente:
    ```bash
    cp .env.example .env
    ```
5. Gere a chave de criptografia da aplicação:
    ```bash
    php artisan key:generate
    ```
6. Execute as migrações do banco de dados e execute os seeders:
    ```bash
    php artisan migrate --seed
    ```
7. Execute o servidor de desenvolvimento:
    ```bash
    php artisan serve
    ```
8. Acesse a aplicação no endereço `http://localhost:8000`

## Executar a aplicação utilizando Docker

1. Clone o repositório:
    ```bash
     git clone https://github.com/Lucassamuel97/tcc.git
2. Acesse a pasta do projeto:
    ```bash
    cd tcc
    ```
3. Execute o container:
    ```bash
    docker-compose up -d
    ```
4. Acesse a aplicação no endereço `http://localhost:8000`





