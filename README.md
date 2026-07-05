# Mini Sistema Web — Desenvolvimento Web II

Sistema web desenvolvido em PHP com MySQL, containerizado com Docker.

---

## Requisitos

- [Docker](https://www.docker.com/) instalado na máquina

---

## Como executar o projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/Laronka/MiniSistemaWeb.git
cd MiniSistemaWeb
```

### 2. Subir os containers

```bash
docker compose up -d
```

Aguarde alguns segundos para o MySQL inicializar completamente.

### 3. Criar a base de dados e restaurar os dados

Acesse o phpMyAdmin em **http://localhost:8081**

- Usuário: `root`
- Senha: `1234`

Vá na aba **Importar**, selecione o arquivo `loja.sql` da raiz do projeto e clique em **Importar**.

O banco `loja` será criado automaticamente com todas as tabelas e dados.

---

## Acessar o sistema

Abra o navegador em **http://localhost:8080**

### Credenciais de login

| Campo | Valor |
|-------|-------|
| E-mail | `joao@gmail.com` |
| Senha | `Elo2026!` |

---

## Estrutura do projeto

```
├── www/
│   ├── conecta.php
│   ├── login.php
│   ├── processa_login.php
│   ├── auth.php
│   ├── menu.php
│   ├── index.php
│   ├── logout.php
│   ├── categorias/
│   │   ├── listar.php
│   │   ├── cadastrar.php
│   │   ├── processa.php
│   │   ├── editar.php
│   │   └── excluir.php
│   └── produtos/
│       ├── listar.php
│       ├── cadastrar.php
│       ├── processa.php
│       ├── editar.php
│       └── excluir.php
├── loja.sql
├── docker-compose.yml
└── Dockerfile
```
