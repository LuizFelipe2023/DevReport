

# 📦 DEV REPORT - Sistema de Versionamento

Sistema web para controle de versionamento de projetos, permitindo gerenciar versões e documentos de forma organizada.

## 🚀 Tecnologias

* Laravel (PHP)
* SQLite
* Bootstrap
* JavaScript / jQuery

## 📚 Estrutura

O sistema possui 4 entidades principais:

* **Usuário**
* **Projeto** → possui vários *versionamentos*
* **Versionamento** → possui vários *documentos*
* **Documento**

### 🔗 Relacionamento

```text
Projeto → Versionamentos → Documentos
```

## ⚙️ Funcionalidades

* CRUD de projetos
* Controle de versionamento
* Upload e gerenciamento de documentos
* Interface simples e responsiva

## 🛠️ Instalação

```bash
git clone <repo>
cd <repo>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## 🗄️ Banco

```env
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/database.sqlite
```
