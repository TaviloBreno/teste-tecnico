# 🏗️ ARQUITETURA DO SISTEMA DE VENDAS

## 📁 ESTRUTURA COMPLETA DE PASTAS E ARQUIVOS

```
sistema-vendas/
│
├── 📁 app/                                    # Lógica principal da aplicação
│   ├── 📁 Http/                              # Camada HTTP
│   │   ├── 📁 Controllers/                   # Controladores MVC
│   │   │   ├── 📁 Auth/                      # Controladores de autenticação
│   │   │   ├── 📄 ClienteController.php      # Gestão de clientes
│   │   │   ├── 📄 Controller.php             # Controller base
│   │   │   ├── 📄 DashboardController.php    # Dashboard principal
│   │   │   ├── 📄 FormaPagamentoController.php # Formas de pagamento
│   │   │   ├── 📄 ItemVendaController.php    # Itens de venda
│   │   │   ├── 📄 ParcelaController.php      # Parcelas de pagamento
│   │   │   ├── 📄 ProdutoController.php      # Gestão de produtos
│   │   │   ├── 📄 ProfileController.php      # Perfil do usuário
│   │   │   ├── 📄 RelatorioController.php    # Relatórios PDF/CSV
│   │   │   └── 📄 VendaController.php        # Gestão de vendas
│   │   └── 📁 Requests/                      # Validações de requisições
│   │
│   ├── 📁 Models/                            # Modelos Eloquent ORM
│   │   ├── 📄 Cliente.php                    # Modelo de clientes
│   │   ├── 📄 FormaPagamento.php             # Modelo de formas de pagamento
│   │   ├── 📄 ItemVenda.php                  # Modelo de itens de venda
│   │   ├── 📄 Parcela.php                    # Modelo de parcelas
│   │   ├── 📄 Produto.php                    # Modelo de produtos
│   │   ├── 📄 User.php                       # Modelo de usuários
│   │   └── 📄 Venda.php                      # Modelo de vendas
│   │
│   ├── 📁 Providers/                         # Provedores de serviços
│   │   └── 📄 AppServiceProvider.php         # Provedor principal
│   │
│   ├── 📁 Services/                          # Camada de lógica de negócio
│   │   ├── 📄 ClienteService.php             # Serviços de clientes
│   │   ├── 📄 FormaPagamentoService.php      # Serviços de formas pagamento
│   │   ├── 📄 ItemVendaService.php           # Serviços de itens de venda
│   │   ├── 📄 ParcelaService.php             # Serviços de parcelas
│   │   ├── 📄 ProdutoService.php             # Serviços de produtos
│   │   └── 📄 VendaService.php               # Serviços de vendas
│   │
│   └── 📁 View/                              # Componentes de view
│       └── 📁 Components/                    # Componentes reutilizáveis
│
├── 📁 bootstrap/                             # Bootstrap do Laravel
│   ├── 📄 app.php                           # Inicialização da aplicação
│   ├── 📄 providers.php                     # Registro de provedores
│   └── 📁 cache/                            # Cache de configuração
│       ├── 📄 packages.php                  # Cache de pacotes
│       └── 📄 services.php                  # Cache de serviços
│
├── 📁 config/                                # Configurações da aplicação
│   ├── 📄 app.php                           # Configuração principal
│   ├── 📄 auth.php                          # Configuração de autenticação
│   ├── 📄 cache.php                         # Configuração de cache
│   ├── 📄 database.php                      # Configuração do banco de dados
│   ├── 📄 dompdf.php                        # Configuração do DomPDF
│   ├── 📄 filesystems.php                   # Sistemas de arquivos
│   ├── 📄 logging.php                       # Configuração de logs
│   ├── 📄 mail.php                          # Configuração de e-mail
│   ├── 📄 queue.php                         # Configuração de filas
│   ├── 📄 services.php                      # Serviços externos
│   └── 📄 session.php                       # Configuração de sessões
│
├── 📁 database/                              # Banco de dados e migrações
│   ├── 📄 database.sqlite                   # Banco SQLite local
│   ├── 📄 .gitignore                        # Ignorar arquivos do Git
│   │
│   ├── 📁 factories/                        # Factories para testes
│   │   └── 📄 UserFactory.php               # Factory de usuários
│   │
│   ├── 📁 migrations/                       # Migrações das tabelas
│   │   ├── 📄 0001_01_01_000000_create_users_table.php
│   │   ├── 📄 0001_01_01_000001_create_cache_table.php
│   │   ├── 📄 0001_01_01_000002_create_jobs_table.php
│   │   ├── 📄 2025_07_04_172904_create_forma_pagamentos_table.php
│   │   ├── 📄 2025_07_04_172905_create_clientes_table.php
│   │   ├── 📄 2025_07_04_172906_create_produtos_table.php
│   │   ├── 📄 2025_07_04_172906_create_vendas_table.php
│   │   ├── 📄 2025_07_04_172907_create_item_vendas_table.php
│   │   ├── 📄 2025_07_04_172907_create_parcelas_table.php
│   │   └── 📄 2025_07_04_202949_add_estoque_to_produtos_table.php
│   │
│   └── 📁 seeders/                          # Dados iniciais (seeds)
│       ├── 📄 DatabaseSeeder.php            # Seeder principal
│       ├── 📄 ClienteSeeder.php             # Dados iniciais de clientes
│       ├── 📄 FormaPagamentoSeeder.php      # Dados de formas de pagamento
│       ├── 📄 ProdutoSeeder.php             # Dados iniciais de produtos
│       ├── 📄 UserSeeder.php                # Dados iniciais de usuários
│       ├── 📄 VendaSeeder.php               # Dados iniciais de vendas
│       └── 📄 VendaItemSeeder.php           # Dados de itens de venda
│
├── 📁 lang/                                  # Traduções e localização
│   ├── 📄 pt_BR.json                        # Traduções em português
│   ├── 📁 en/                               # Traduções em inglês
│   └── 📁 pt_BR/                            # Traduções completas PT-BR
│
├── 📁 public/                                # Arquivos públicos
│   ├── 📄 index.php                         # Ponto de entrada da aplicação
│   ├── 📄 favicon.ico                       # Ícone do site
│   ├── 📄 robots.txt                        # Robots para SEO
│   ├── 📄 hot                               # Arquivo do Vite (dev)
│   └── 📁 build/                            # Assets compilados
│
├── 📁 resources/                             # Recursos da aplicação
│   ├── 📁 css/                              # Arquivos CSS
│   │   └── 📄 app.css                       # CSS principal com Tailwind
│   │
│   ├── 📁 js/                               # Arquivos JavaScript
│   │   └── 📄 app.js                        # JavaScript principal
│   │
│   └── 📁 views/                            # Templates Blade
│       ├── 📄 dashboard.blade.php           # Dashboard principal
│       ├── 📄 welcome.blade.php             # Página de boas-vindas
│       │
│       ├── 📁 auth/                         # Views de autenticação
│       │   ├── 📄 login.blade.php           # Página de login
│       │   ├── 📄 register.blade.php        # Página de registro
│       │   └── 📄 ...                       # Outras views de auth
│       │
│       ├── 📁 clientes/                     # CRUD de clientes
│       │   ├── 📄 index.blade.php           # Listagem de clientes
│       │   ├── 📄 create.blade.php          # Criar cliente
│       │   ├── 📄 edit.blade.php            # Editar cliente
│       │   └── 📄 show.blade.php            # Visualizar cliente
│       │
│       ├── 📁 produtos/                     # CRUD de produtos
│       │   ├── 📄 index.blade.php           # Listagem de produtos
│       │   ├── 📄 create.blade.php          # Criar produto
│       │   ├── 📄 edit.blade.php            # Editar produto
│       │   └── 📄 show.blade.php            # Visualizar produto
│       │
│       ├── 📁 vendas/                       # CRUD de vendas
│       │   ├── 📄 index.blade.php           # Listagem de vendas
│       │   ├── 📄 create.blade.php          # Criar venda
│       │   ├── 📄 edit.blade.php            # Editar venda
│       │   └── 📄 show.blade.php            # Visualizar venda
│       │
│       ├── 📁 forma_pagamentos/             # CRUD de formas de pagamento
│       │   ├── 📄 index.blade.php           # Listagem de formas
│       │   ├── 📄 create.blade.php          # Criar forma
│       │   └── 📄 edit.blade.php            # Editar forma
│       │
│       ├── 📁 relatorios/                   # Relatórios
│       │   ├── 📄 index.blade.php           # Página de relatórios
│       │   └── 📄 vendas.blade.php          # Relatório de vendas
│       │
│       ├── 📁 components/                   # Componentes reutilizáveis
│       │   ├── 📄 navigation.blade.php      # Navegação
│       │   ├── 📄 sidebar.blade.php         # Barra lateral
│       │   └── 📄 ...                       # Outros componentes
│       │
│       ├── 📁 layouts/                      # Layouts base
│       │   ├── 📄 app.blade.php             # Layout principal
│       │   ├── 📄 guest.blade.php           # Layout para visitantes
│       │   └── 📄 ...                       # Outros layouts
│       │
│       └── 📁 profile/                      # Perfil do usuário
│           ├── 📄 edit.blade.php            # Editar perfil
│           └── 📄 ...                       # Outras views de perfil
│
├── 📁 routes/                                # Rotas da aplicação
│   ├── 📄 web.php                           # Rotas web principais
│   ├── 📄 auth.php                          # Rotas de autenticação
│   └── 📄 console.php                       # Comandos do console
│
├── 📁 storage/                               # Armazenamento
│   ├── 📁 app/                              # Arquivos da aplicação
│   ├── 📁 framework/                        # Cache e sessões
│   └── 📁 logs/                             # Logs da aplicação
│
├── 📁 tests/                                 # Testes automatizados
│   ├── 📄 TestCase.php                      # Classe base de testes
│   ├── 📁 Feature/                          # Testes de funcionalidade
│   └── 📁 Unit/                             # Testes unitários
│
├── 📁 vendor/                                # Dependências PHP (Composer)
│   ├── 📄 autoload.php                      # Autoloader
│   ├── 📁 laravel/                          # Framework Laravel
│   ├── 📁 barryvdh/                         # DomPDF
│   ├── 📁 doctrine/                         # Doctrine DBAL
│   ├── 📁 guzzlehttp/                       # Cliente HTTP
│   ├── 📁 monolog/                          # Sistema de logs
│   ├── 📁 phpunit/                          # Framework de testes
│   ├── 📁 symfony/                          # Componentes Symfony
│   └── 📁 ...                               # Outras dependências
│
├── 📁 node_modules/                          # Dependências Node.js
│
├── 📄 .env                                   # Variáveis de ambiente
├── 📄 .env.example                          # Exemplo de .env
├── 📄 .gitignore                            # Arquivos ignorados pelo Git
├── 📄 .gitattributes                        # Atributos do Git
├── 📄 .editorconfig                         # Configuração do editor
├── 📄 artisan                               # CLI do Laravel
├── 📄 composer.json                         # Dependências PHP
├── 📄 composer.lock                         # Lock das dependências PHP
├── 📄 package.json                          # Dependências Node.js
├── 📄 package-lock.json                     # Lock das dependências Node.js
├── 📄 phpunit.xml                           # Configuração do PHPUnit
├── 📄 postcss.config.js                     # Configuração do PostCSS
├── 📄 tailwind.config.js                    # Configuração do Tailwind CSS
├── 📄 vite.config.js                        # Configuração do Vite
└── 📄 README.md                             # Documentação do projeto
```

## 🎯 DESCRIÇÃO DAS PRINCIPAIS PASTAS

### 📁 app/ - Lógica Principal
- **Http/Controllers/**: Controladores que recebem requisições HTTP
- **Models/**: Modelos Eloquent representando tabelas do banco
- **Services/**: Lógica de negócio separada dos controladores
- **Providers/**: Provedores de serviços do Laravel
- **View/Components/**: Componentes reutilizáveis de view

### 📁 resources/ - Recursos Frontend
- **views/**: Templates Blade para renderização HTML
- **css/**: Arquivos de estilo (Tailwind CSS)
- **js/**: Arquivos JavaScript (Alpine.js)

### 📁 database/ - Banco de Dados
- **migrations/**: Scripts de criação e alteração de tabelas
- **seeders/**: Dados iniciais para popular o banco
- **factories/**: Geradores de dados para testes
- **database.sqlite**: Banco SQLite para desenvolvimento

### 📁 config/ - Configurações
- **app.php**: Configuração principal da aplicação
- **database.php**: Configuração de conexão com banco
- **auth.php**: Configuração de autenticação
- **dompdf.php**: Configuração para geração de PDFs

### 📁 public/ - Arquivos Públicos
- **index.php**: Ponto de entrada da aplicação
- **build/**: Assets compilados pelo Vite
- **favicon.ico**: Ícone do site

### 📁 routes/ - Rotas
- **web.php**: Rotas web principais
- **auth.php**: Rotas de autenticação
- **console.php**: Comandos artisan personalizados

### 📁 storage/ - Armazenamento
- **app/**: Arquivos da aplicação
- **logs/**: Logs do sistema
- **framework/**: Cache e sessões

### 📁 tests/ - Testes
- **Feature/**: Testes de funcionalidades completas
- **Unit/**: Testes unitários de componentes

## 🔄 FLUXO DE DADOS DA APLICAÇÃO

```
1. 📱 FRONTEND (Blade Templates + Tailwind CSS)
   ↓
2. 🛣️ ROUTES (web.php)
   ↓
3. 🎮 CONTROLLERS (Http/Controllers/)
   ↓
4. 🔧 SERVICES (Services/)
   ↓
5. 📊 MODELS (Models/ - Eloquent ORM)
   ↓
6. 💾 DATABASE (SQLite/MySQL)
```

## 🛠️ PRINCIPAIS TECNOLOGIAS E DEPENDÊNCIAS

### Backend (PHP/Laravel)
- **Laravel 12.x**: Framework PHP principal
- **Eloquent ORM**: Mapeamento objeto-relacional
- **Laravel Breeze**: Sistema de autenticação
- **DomPDF**: Geração de relatórios em PDF
- **SQLite**: Banco de dados para desenvolvimento
- **PHPUnit**: Framework de testes

### Frontend
- **Blade Templates**: Sistema de templates do Laravel
- **Tailwind CSS**: Framework CSS utility-first
- **Alpine.js**: Framework JavaScript leve
- **Chart.js**: Biblioteca para gráficos
- **Vite**: Build tool para assets

### Ferramentas de Desenvolvimento
- **Composer**: Gerenciador de dependências PHP
- **NPM**: Gerenciador de dependências Node.js
- **Artisan**: CLI do Laravel
- **Git**: Controle de versão

## 📊 ESTRUTURA DO BANCO DE DADOS

### Tabelas Principais
1. **users** - Usuários do sistema
2. **clientes** - Clientes cadastrados
3. **produtos** - Produtos disponíveis
4. **vendas** - Vendas realizadas
5. **item_vendas** - Itens de cada venda
6. **forma_pagamentos** - Formas de pagamento
7. **parcelas** - Parcelas dos pagamentos

### Relacionamentos
- **Venda** possui muitos **ItemVenda**
- **Venda** pertence a um **Cliente**
- **Venda** possui uma **FormaPagamento**
- **Venda** possui muitas **Parcelas**
- **ItemVenda** pertence a um **Produto**

## 🎨 PADRÕES ARQUITETURAIS UTILIZADOS

1. **MVC (Model-View-Controller)**: Separação de responsabilidades
2. **Service Layer**: Lógica de negócio isolada
3. **Repository Pattern**: Abstração de acesso a dados
4. **Dependency Injection**: Injeção de dependências
5. **Eloquent ORM**: Mapeamento objeto-relacional
6. **Blade Components**: Componentes reutilizáveis
7. **RESTful Routes**: Padrão REST para APIs

## 🚀 FUNCIONALIDADES IMPLEMENTADAS

### Gestão de Clientes
- Cadastro, edição, visualização e exclusão
- Listagem com paginação e busca
- Validação de dados

### Gestão de Produtos
- CRUD completo de produtos
- Controle de estoque
- Categorização

### Sistema de Vendas
- Criação de vendas com múltiplos itens
- Cálculo automático de totais
- Controle de parcelas
- Diferentes formas de pagamento

### Relatórios
- Relatórios de vendas por período
- Exportação em PDF e CSV
- Gráficos dinâmicos no dashboard

### Autenticação
- Sistema de login/logout
- Registro de usuários
- Proteção de rotas
- Perfil do usuário

Esta arquitetura garante **manutenibilidade**, **escalabilidade** e **organização** do código, seguindo as melhores práticas do Laravel e padrões de desenvolvimento web modernos.
