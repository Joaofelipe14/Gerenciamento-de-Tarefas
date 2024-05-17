# Sistema de Gerenciamento de Tarefas

## Objetivo do Projeto

Desenvolver um sistema de gerenciamento de tarefas com autenticação de usuários, permitindo criar, listar, atualizar e excluir tarefas. Visando boas práticas de aplicações como padrão MVC , autenticação com  Firebase e consulta em banco de dados de forma eficiente e principalmente focando na integração entre back-end e front-end.

## Back-end (Laravel API)

### Configuração do Projeto e Caracteristicas

- Projeto Laravel utilizando o Composer , para configurar o banco de dados no arquivo alterar`.env`.
- Utilizar o sistema de autenticação padrão do Laravel e proteger as rotas com autenticação.
- Documentação em swagger 

### Configuração do Projeto e Caracteristicas
Apos o arquivo env gerado e configurado execute dentro da pasta back-end:
   ```
   composer install
   php artisan migrate
   php artisan serve

   ```

## Front-end (Vue.js)

### Configuração do Projeto

- Projeto Vue.js utilizando o Vue CLI.
- Ultiliza o Firebase Authentication para proteger as rotas da aplicação
- Consumir a API Laravel para exibir e gerenciar as tarefas no front-end.
- Componentes separados do Vue para facilitar a reutilização e usando props para passar dados entre eles.

Dentro da pasta front-end:
   ```
   npm install
   npm run serve
   php artisan serve

   ```

---
# Testando projeto

Com os dois projetos em execução para ver melhor as rotas da api acesse o back-end :
  ```
   http://localhost:8000/api/documentation#/

   ```

Para ver o front-end acesse dados padroes
email  test@example.com
password password
  ```
http://localhost:8080/login
   ```
---


# Rotas da Api
## Rotas de Usuário
### Registro de Usuário

- **URL:** `/register`
- **Método:** `POST`
- **Descrição:** Registra um novo usuário.
- **Parâmetros:**
  - `name`: Nome do usuário.
  - `email`: Endereço de e-mail do usuário.
  - `password`: Senha do usuário.
  - `c_password`: Senha do usuário.


### Login de Usuário

- **URL:** `/login`
- **Método:** `POST`
- **Descrição:** Autentica um usuário existente.
- **Parâmetros:**
  - `email`: Endereço de e-mail do usuário.
  - `password`: Senha do usuário.
- **Descrição:** Retorna dados do userio e o token.


## Rotas de Tarefas 
Para acessar essas rotas, é necessário incluir o cabeçalho 'Authorization' com o token de autenticação do usuário.

### Listar Tarefas

- **URL:** `/tasks`
- **Método:** `GET`

### Criar Tarefa

- **URL:** `/tasks`
- **Método:** `POST`
- **Parâmetros:**
  - `title`: Título da tarefa.
  - `description`: Descrição da tarefa.

### Atualizar Tarefa

- **URL:** `/tasks/{id}`
- **Método:** `PUT`
- **Descrição:** Atualiza uma tarefa existente do usuário autenticado.
- **Parâmetros:**
  - `title`: Novo título da tarefa (opcional).
  - `description`: Nova descrição da tarefa (opcional).

### Excluir Tarefa

- **URL:** `/tasks/{id}`
- **Método:** `DELETE`

### Obter Tarefas por ID

- **URL:** `/task_id/{id_task}`
- **Método:** `GET`
- **Descrição:** Obtém as tarefas associadas a um ID de tarefa específico.

### Obter Informações do Usuário

- **URL:** `/me`
- **Método:** `GET`
- **Descrição:** Retorna informações do usuário autenticado.

---

