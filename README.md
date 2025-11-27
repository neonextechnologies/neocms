# 🚀 NeoCMS - Modern Modular Monolith CMS

<div align="center">

![PHP Version](https://img.shields.io/badge/PHP-8.0%20to%208.4-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
![Architecture](https://img.shields.io/badge/Architecture-Modular%20Monolith-blue?style=flat-square)
![Type](https://img.shields.io/badge/Type-Full%20Stack%20CMS-purple?style=flat-square)

**Enterprise-grade Content Management System built on NeoFramework**  
*Modular Monolith Architecture with Full-Stack Capabilities*

[Features](#-features) • [Quick Start](#-quick-start) • [Architecture](#-architecture) • [Documentation](#-documentation)

</div>

---

## 📖 About NeoCMS

**NeoCMS** is a modern, enterprise-grade Content Management System built on NeoFramework. It follows the **Modular Monolith** architecture pattern, providing the benefits of microservices (modularity, independent development) while maintaining the simplicity of a monolithic deployment.

### 🎯 Key Highlights

- 🏗️ **Modular Monolith** - Clean module boundaries with independent features
- 🎨 **Full-Stack CMS** - Complete solution for content management
- 🔐 **Enterprise Auth** - Multi-guard authentication & RBAC
- 📦 **Plugin System** - Extensible architecture for custom modules
- 🗄️ **Advanced ORM** - Eloquent-like database layer
- 🌍 **Multi-language** - Built-in i18n support
- 🎭 **Theme System** - Customizable frontend themes
- ⚡ **High Performance** - Optimized caching and query performance

---

## ✨ Features

### 🏗️ Modular Architecture

**Clean separation of concerns with domain modules:**

```
modules/
├── content/          # Content management (pages, posts, media)
├── user/            # User management & authentication
├── ecommerce/       # E-commerce capabilities (optional)
├── blog/            # Blogging platform (optional)
└── admin/           # Admin dashboard & management
```

Each module is:
- ✅ **Self-contained** - Own controllers, models, views, routes
- ✅ **Independent** - Can be enabled/disabled individually
- ✅ **Reusable** - Can be shared across projects
- ✅ **Testable** - Isolated testing per module

### 📝 Content Management

**Flexible content types and management:**

```php
// Create content types
ContentType::create([
    'name' => 'Product',
    'fields' => [
        ['name' => 'title', 'type' => 'string'],
        ['name' => 'price', 'type' => 'decimal'],
        ['name' => 'description', 'type' => 'richtext'],
        ['name' => 'images', 'type' => 'media[]']
    ]
]);

// Manage content
Content::create([
    'type' => 'product',
    'title' => 'Awesome Product',
    'status' => 'published',
    'fields' => [...]
]);
```

### 🎭 Theme System

**Customizable themes with template inheritance:**

```blade
{{-- themes/default/layouts/app.blade.php --}}
@extends('cms::base')

@section('header')
    @include('theme::partials.header')
@endsection

@section('content')
    @yield('page-content')
@endsection
```

### 🔐 User & Permissions

**Role-based access control:**

```php
// Define roles & permissions
Role::create(['name' => 'editor']);
Permission::create(['name' => 'edit-posts']);

// Assign to users
$user->assignRole('editor');
$user->givePermissionTo('edit-posts');

// Check permissions
if ($user->can('edit-posts')) {
    // Allow editing
}
```

### 📦 Module System

**Create and manage modules:**

```bash
# Create new module
php neo make:module Shop

# Enable/disable modules
php neo module:enable Shop
php neo module:disable Shop

# List all modules
php neo module:list
```

### 🗄️ Advanced Features

- ✅ **Media Library** - Centralized asset management
- ✅ **SEO Tools** - Meta tags, sitemaps, structured data
- ✅ **Workflow** - Content approval workflows
- ✅ **Versioning** - Content revision history
- ✅ **Multi-site** - Manage multiple sites
- ✅ **API Ready** - RESTful API for headless CMS
- ✅ **Form Builder** - Visual form creation
- ✅ **Widget System** - Reusable UI components

---

## 🚀 Quick Start

### Installation

```bash
# Clone the repository
git clone https://github.com/neonextechnologies/neocms.git
cd neocms

# Install dependencies
composer install

# Setup environment
cp .env.example .env

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=neocms
DB_USERNAME=root
DB_PASSWORD=

# Generate application key
php neo app:key

# Run migrations
php neo migrate

# Seed initial data (admin user, roles, etc.)
php neo db:seed

# Start development server
php neo serve
```

Visit: `http://localhost:8000`

**Default Admin Credentials:**
- Email: `admin@neocms.local`
- Password: `password`

### Quick Configuration

Edit `.env` file:

```env
APP_NAME=NeoCMS
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=neocms
DB_USERNAME=root
DB_PASSWORD=

# Cache (optional)
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

---

## 🏗️ Architecture

### Modular Monolith Pattern

NeoCMS follows the **Modular Monolith** architecture:

```
┌─────────────────────────────────────────┐
│           Application Layer             │
│  (Routes, Middleware, Entry Points)     │
└─────────────────────────────────────────┘
                    │
        ┌───────────┼───────────┐
        ▼           ▼           ▼
    ┌────────┐  ┌────────┐  ┌────────┐
    │Content │  │  User  │  │ Admin  │
    │Module  │  │ Module │  │ Module │
    └────────┘  └────────┘  └────────┘
        │           │           │
        └───────────┼───────────┘
                    ▼
        ┌───────────────────────┐
        │   Shared Kernel       │
        │ (ORM, Auth, Cache)    │
        └───────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │     Infrastructure    │
        │  (DB, Queue, Storage) │
        └───────────────────────┘
```

### Module Structure

Each module is self-contained:

```
modules/content/
├── ContentModule.php       # Module definition
├── Controllers/           # HTTP controllers
├── Models/               # Domain models
├── Services/             # Business logic
├── Repositories/         # Data access
├── Views/                # Templates
├── Routes/               # Module routes
│   ├── web.php
│   └── api.php
├── Migrations/           # Database migrations
├── Policies/             # Authorization
├── Events/               # Domain events
├── Listeners/            # Event handlers
├── Tests/                # Module tests
├── config.php            # Module config
└── module.json           # Module metadata
```

---

## 🛠️ Development

### Create a Module

```bash
# Generate full module structure
php neo make:module Blog --full

# This creates:
modules/blog/
├── BlogModule.php
├── Controllers/
├── Models/
├── Services/
├── Views/
├── Routes/
├── Migrations/
└── Tests/
```

### Module Development

```php
<?php
// modules/blog/BlogModule.php

namespace Modules\Blog;

use NeoPhp\Core\Attributes\Module;

#[Module(
    name: 'blog',
    version: '1.0.0',
    description: 'Blog management module',
    providers: [BlogServiceProvider::class]
)]
class BlogModule
{
    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadViews();
        $this->loadMigrations();
    }
    
    protected function loadRoutes(): void
    {
        require __DIR__ . '/Routes/web.php';
    }
}
```

### Generate Module Components

```bash
# Controller
php neo make:controller Blog/PostController --module=blog

# Model
php neo make:model Blog/Post --module=blog -m

# Service
php neo make:service Blog/PostService --module=blog

# Repository
php neo make:repository Blog/PostRepository --module=blog

# Migration
php neo make:migration create_posts_table --module=blog
```

---

## 📦 Core Modules

### Content Module
Manages all content types, pages, and media.

### User Module
Authentication, user management, roles & permissions.

### Admin Module
Administrative dashboard and management interface.

### Theme Module
Frontend theme management and customization.

---

## 🧪 Testing

```bash
# Run all tests
php neo test

# Run specific module tests
php neo test --module=content

# Run with coverage
php neo test --coverage
```

---

## 📚 Documentation

- 📖 [Installation Guide](docs/installation.md)
- 🏗️ [Architecture Overview](docs/architecture.md)
- 📦 [Module Development](docs/modules.md)
- 🎨 [Theme Development](docs/themes.md)
- 🔌 [Plugin Development](docs/plugins.md)
- 🔐 [Security Guide](docs/security.md)
- ⚡ [Performance Optimization](docs/performance.md)

---

## 🗺️ Roadmap

### Phase 1: Core CMS (Current)
- ✅ Module system foundation
- ✅ Content management basics
- ✅ User authentication & authorization
- ✅ Admin dashboard

### Phase 2: Advanced Features
- 🔄 Media library with transformations
- 🔄 SEO & metadata management
- 🔄 Workflow & content approval
- 🔄 Multi-language content

### Phase 3: Extensions
- 📋 E-commerce module
- 📋 Blog platform
- 📋 Form builder
- 📋 Newsletter system

### Phase 4: Enterprise
- 📋 Multi-site management
- 📋 CDN integration
- 📋 Advanced caching
- 📋 Performance monitoring

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Development Setup

```bash
git clone https://github.com/neonextechnologies/neocms.git
cd neocms
composer install
cp .env.example .env
php neo app:key
php neo migrate --seed
```

---

## 📄 License

MIT License - See [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

Built on top of:
- **NeoFramework** - Core framework foundation
- Inspired by **Laravel**, **Statamic**, and **Craft CMS**

---

<div align="center">

**Built with ❤️ by [Neonex Technologies](https://neonex.co.th)**

[![GitHub](https://img.shields.io/badge/GitHub-neonextechnologies-181717?style=flat-square&logo=github)](https://github.com/neonextechnologies)

</div>
