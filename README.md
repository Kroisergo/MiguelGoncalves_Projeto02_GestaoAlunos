<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Projeto: Sistema de Gestão de Alunos Laravel
Este projeto é uma aplicação web desenvolvida com o framework Laravel para gerir os registos de alunos.


## Funcionalidades Principais:
* **Gestão de Alunos (CRUD):**
    * Criação, listagem, edição e eliminação de registos de alunos;
    * Campos: Nome Completo, Data de Nascimento, Email, Número de Telemóvel, Curso, Número de Matrícula, Ano de Inscrição, Status;
    * Validação de dados;
    * Filtros por Curso, Status e Idade;
    * Exportação de dados para Excel.
* **Sistema de Autenticação:**
    * Login;
    * Registo;
    * Recuperação de Password (Laravel Breeze).
* **Sistema de Autorização por Roles:**
    * `admin`: Acesso completo (CRUD, Exportação);
    * `user`: Acesso à criação e consulta de alunos;
    * Controlo/autorização de acesso por Gates e middlewares.


## Tecnologias Utilizadas:
* Laravel (v10.x ou superior);
* PHP (v8.1 ou superior);
* Composer;
* Node.js e NPM;
* Blade Templates;
* TailwindCSS;
* Bootstrap 5;
* MySQL;
* Laravel Herd (para servir a aplicação);
* TablePlus (Base de Dados);
* Git e GitHub.


## Instalação e Configuração:
Deve seguir estes passos para colocar o projeto a funcionar na sua máquina local:

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/TeuUtilizadorGitHub/TeuNomeDoRepositorio.git](https://github.com/TeuUtilizadorGitHub/TeuNomeDoRepositorio.git)
    cd TeuNomeDoRepositorio
    ```
2.  **Configurar a Base de Dados (MySQL via XAMPP):**
    * Certifique-se de que o **XAMPP** está instalado. Vamos usar apenas o **MySQL do XAMPP**.
    * **Importante (Windows):** Se o MySQL não iniciar devido à porta 3306 estar ocupada:
        1.  Abra o CMD (Prompt de Comando) como **Administrador**.
        2.  Pesquise o PID do processo que está a usar a porta 3306:
            ```bash
            netstat -ano | findstr :3306
            ```
        3.  Identifique o número do PID (última coluna, ex: `1234`).
        4.  Termine o processo usando esse PID:
            ```bash
            taskkill /PID 1234 /F
            ```
            (Substitua `1234` pelo PID que encontrou).
        5.  Agora pode iniciar o MySQL no painel de controlo do XAMPP.
    * Crie uma nova base de dados no MySQL (pode usar o phpMyAdmin do XAMPP ou o **TablePlus**). Anote o nome da BD, username e password.
    * **Configure o ficheiro `.env`:**
        * Crie o ficheiro `.env` a partir do `.env.example`:
            ```bash
            cp .env.example .env
            ```
        * Abra o `.env` e configure as credenciais da base de dados:
            ```dotenv
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=o_nome_da_tua_bd # <-- SUBSTITUIR
            DB_USERNAME=o_teu_user_bd    # <-- SUBSTITUIR
            DB_PASSWORD=a_tua_password_bd # <-- SUBSTITUIR
            ```
        * Gere a chave da aplicação:
            ```bash
            php artisan key:generate
            ```

3.  **Instale as dependências do Composer:**
    ```bash
    composer install
    ```
4.  **Execute as migrations e seeders (para criar tabelas e dados iniciais, incluindo utilizadores admin/user):**
    ```bash
    php artisan migrate --seed
    ```
5.  **Instale as dependências do NPM e compile os assets:**
    ```bash
    npm install
    npm run dev # Para desenvolvimento (e manter o servidor de assets a correr)
    # ou npm run build # Para produção (compila e sai)
    ```
6.  **Inicie o servidor de desenvolvimento com Laravel Herd:**
    * Certifique-se de que tem o **Laravel Herd** instalado e configurado para servir a pasta raiz do projeto.
    * Acesse a aplicação no navegador através do domínio do Herd (ex: `http://workopia.test` ou o que tenhas configurado para o teu projeto no Herd).


## Utilizadores de Teste:
* **Administrador:**
    * Email: `admin@example.com`
    * Password: `password`
* **Utilizador Comum:**
    * Email: `user@example.com`
    * Password: `password`


## Controlo de Versão:
Este projeto utiliza Git.


## Criado por:
Nome: Miguel Gonçalves
Nr: 20170996
