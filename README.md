# 🛒 Sistema de Vendas

Um sistema web completo e moderno para **gestão de vendas**, com controle de clientes, produtos, parcelamentos, relatórios e gráficos de desempenho. Desenvolvido com **Laravel 12**, **Tailwind CSS** e **Blade**, é ideal para pequenas e médias empresas que buscam eficiência, praticidade e visualização de dados em tempo real.

---

## 🚀 Funcionalidades Principais

- ✅ Cadastro e gerenciamento de **clientes**
- ✅ CRUD completo de **produtos**
- ✅ Registro de **vendas com parcelamento personalizado**
- ✅ Cálculo automático e edição manual de **valores de parcelas**
- ✅ Controle de **formas de pagamento**
- ✅ **Relatórios de vendas** com filtros por data, cliente e exportação para **PDF/CSV**
- ✅ **Dashboard com gráficos interativos** de desempenho (Chart.js)
- ✅ Autenticação de usuários (Laravel Breeze)
- ✅ Interface responsiva e moderna com **Tailwind CSS**

---

## 🧰 Tecnologias Utilizadas

| Tecnologia         | Finalidade                            |
|--------------------|----------------------------------------|
| **Laravel 12.x**   | Backend, MVC, rotas e lógica de negócio |
| **PHP 8.3+**       | Linguagem principal                     |
| **MySQL 8+**       | Banco de dados relacional              |
| **Tailwind CSS**   | Estilização moderna e responsiva       |
| **Blade**          | Templates com sintaxe limpa            |
| **Alpine.js**      | Interatividade leve no frontend        |
| **Chart.js**       | Gráficos dinâmicos no dashboard        |
| **DomPDF**         | Geração de relatórios em PDF           |
| **Laravel Breeze** | Autenticação e scaffolding de login    |

---

## ⚙️ Instalação e Uso Local

### 0️⃣ Pré-requisitos

Certifique-se de ter o **PHP 8.3+** e o **Composer** instalados em sua máquina.

- [Como instalar o PHP](https://www.php.net/manual/pt_BR/install.php)
- [Como instalar o Composer](https://getcomposer.org/download/)

### 1️⃣ Clone o projeto e instale as dependências

```bash
git clone https://github.com/seu-usuario/sistema-vendas.git
cd sistema-vendas

# Instalar dependências PHP
composer install

# Instalar dependências JS/CSS
npm install && npm run dev
```

### 2️⃣ Configure o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` com os dados do seu banco:

```env
DB_DATABASE=sistema_vendas
DB_USERNAME=root
DB_PASSWORD=secret
```

### 3️⃣ Execute as migrations e seeds

```bash
php artisan migrate --seed
```

### 4️⃣ Inicie o servidor local

```bash
php artisan serve
```

Acesse em: [http://localhost:8000](http://localhost:8000)

---

## 📊 Telas e Relatórios

- 📈 **Dashboard** com gráficos de vendas por período
- 🧾 **Relatórios PDF/CSV** com filtros por data e cliente
- 🧮 **Cálculo de parcelas** e ajuste automático de valores

---

## 👨‍💻 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests com melhorias, correções ou sugestões.

---

## 📝 Licença

Este projeto está licenciado sob a MIT License.