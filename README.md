# jwt REST API

A RESTful API application built with Laravel.

## Features

- User authentication (login, registration)
- CRUD operations for resources
- JSON responses for all endpoints
- Secure, token-based access

## Getting Started

1. Clone the repository.
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your environment.
4. Run migrations: `php artisan migrate`
5. Start the server: `php artisan serve`

## Authentication

All protected routes require a valid API token. Use the `/api/login` endpoint to obtain a token.
