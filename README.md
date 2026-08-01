# Task Management API

## Requirements

- PHP 8.3+
- Laravel 12
- Composer
- MySQL

---

## Installation

Clone repository

```bash
git clone git@github.com:AhmedSaeed77/task-management.git
```

Install dependencies

```bash
composer install
```

Copy env

```bash
cp .env.example .env
```

Generate key

```bash
php artisan key:generate
```

Configure Database inside .env

Run migrations

```bash
php artisan migrate --seed
```

Install Sanctum

```bash
php artisan install:api
```

Run project

```bash
php artisan serve
```

---

## Authentication

POST /api/auth-sign/up

POST /api/auth-sign/in

POST /api/auth-sign/out

---

## Projects

GET /api/projects

POST /api/projects

GET /api/projects/{id}

PUT /api/projects/{id}

DELETE /api/projects/{id}

---

## Tasks

GET /api/tasks

POST /api/tasks

PUT /api/tasks/{id}

DELETE /api/tasks/{id}

Filtering

GET /api/tasks?status=todo

GET /api/tasks?priority=high

GET /api/tasks?search=Laravel

---

## Dashboard

GET /api/dashboard

---

## Queue

Run queue

```bash
php artisan queue:work
```
