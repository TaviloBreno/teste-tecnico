# 🛒 Sistema de Vendas

Um sistema web completo para gestão de clientes, produtos, vendas e relatórios, desenvolvido com **Laravel 12**, **Tailwind CSS** e **Livewire/Blade**. Ideal para pequenas e médias empresas que precisam de controle eficiente de vendas com geração de relatórios em **PDF e CSV**.

## 📌 Funcionalidades

- ✅ Cadastro e gerenciamento de **clientes**
- ✅ CRUD de **produtos**
- ✅ Registro de **vendas** com múltiplas parcelas
- ✅ Controle de **formas de pagamento**
- ✅ Relatórios de vendas com filtros por data e geração em **PDF/CSV**
- ✅ Dashboard com **gráficos dinâmicos**
- ✅ Autenticação de usuários

## 🧱 Tecnologias

- PHP 8.3
- Laravel 12.x
- MySQL 8+
- Tailwind CSS
- Alpine.js
- Chart.js (gráficos)
- DomPDF (relatórios em PDF)
- Laravel Breeze (autenticação)
- Laravel Livewire (opcional)

## ⚙️ Instalação

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/sistema-vendas.git
cd sistema-vendas

# Instale as dependências PHP
composer install

# Copie o .env e configure
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env
DB_DATABASE=sistema_vendas
DB_USERNAME=root
DB_PASSWORD=secret

# Rode as migrations e seeds
php artisan migrate --seed

# Instale e compile os assets (Tailwind)
npm install && npm run dev

# Inicie o servidor local
php artisan serve
