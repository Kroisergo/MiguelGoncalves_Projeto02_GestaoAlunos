# Projeto: Sistema de Gestão de Alunos Laravel
Este projeto é uma aplicação web desenvolvida com o framework Laravel para gerir os registos de alunos.

# ----//----

## Funcionalidades Principais:
* **Gestão de Alunos (CRUD):**
    * Criação, listagem, edição e eliminação de registos de alunos.
    * Campos: Nome Completo, Data de Nascimento, Email, Número de Telemóvel, Curso, Número de Matrícula, Ano de Inscrição, Status.
    * Validação de dados.
    * Filtros por Curso, Status e Idade.
    * Exportação de dados para Excel.
* **Sistema de Autenticação:** Login, Registo e Recuperação de Password (via Laravel Breeze).
* **Sistema de Autorização por Roles:**
    * `admin`: Acesso completo (CRUD, Exportação).
    * `user`: Acesso à criação e consulta de alunos.
    * Controlo de acesso via Gates e middlewares.

## Tecnologias Utilizadas:

* Laravel (v10.x ou superior)
* PHP (v8.1 ou superior)
* Composer
* Node.js e NPM/Yarn
* Blade Templates
* TailwindCSS
* Bootstrap 5 (para componentes específicos - se usaste ou pretendes usar)
* MySQL (Base de Dados)
* Git e GitHub para controlo de versão.

## Instalação e Configuração:

Siga estes passos para colocar o projeto a funcionar na sua máquina local:

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/TeuUtilizadorGitHub/TeuNomeDoRepositorio.git](https://github.com/TeuUtilizadorGitHub/TeuNomeDoRepositorio.git)
    cd TeuNomeDoRepositorio
    ```
2.  **Instale as dependências do Composer:**
    ```bash
    composer install
    ```
3.  **Instale as dependências do NPM e compile os assets:**
    ```bash
    npm install
    npm run dev # Para desenvolvimento
    # ou npm run build # Para produção
    ```
4.  **Crie o ficheiro de ambiente e gere a chave da aplicação:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5.  **Configure a base de dados no ficheiro `.env`:**
    Certifique-se de que o MySQL está a correr.
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=o_nome_da_tua_bd
    DB_USERNAME=o_teu_user_bd
    DB_PASSWORD=a_tua_password_bd
    ```
6.  **Execute as migrations e seeders (para criar tabelas e dados iniciais, incluindo utilizadores admin/user):**
    ```bash
    php artisan migrate --seed
    ```
7.  **Inicie o servidor de desenvolvimento do Laravel:**
    ```bash
    php artisan serve
    ```
8.  **Acesse a aplicação no navegador:** `http://127.0.0.1:8000` (ou o URL do Herd, se estiveres a usar).

## Utilizadores de Teste:

* **Administrador:**
    * Email: `admin@admin.com`
    * Password: `admin`
* **Utilizador Comum:**
    * Email: `user@user.com`
    * Password: `user`

## Controlo de Versão:

Este projeto utiliza Git para controlo de versão. Os commits devem ser significativos e refletir as etapas de desenvolvimento do projeto.

## Autor:

[O Teu Nome Completo]
[O Teu Número de Estudante/ID]