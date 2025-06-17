# Laravel JWT API Skeleton

A RESTful API application built with Laravel, designed for secure, token-based user authentication and robust resource management.

# Requirements

- PHP >= 8.2
- MySQL or any Laravel compatible DB engine.

## Features

- **User Authentication**
  - Registration and login endpoints. (Registration can be removed if not necessary)
  - User logout and profile update functionality. (Profile update can be removed if not necessary)
  - JWT cookie-based authentication for secure access.
  - Custom Cookie lifetime via COOKIE_LIFETIME .env variable.
- **Localization**<br>
  Multilingual support via url.
  - All API routes are prefixed with a `{lang}` parameter. (E.g. {{site}}/api/**en**/user-actions)
  - Automatic locale setting via the `setLocale` middleware.
  - Add as many languages as you need to support in your app
- **Role-Based Permissions**
  - Fine-grained access control using custom route permissions.
- **Modular Route Structure**<br>
  Routes allows you to set custom paths so urls can be organized by categories or common groups
  - Grouped routes for user actions and default controller responses. (see api routes)
  - Easy extension for additional modules and controllers. Just create more groups and add any middleware as per your needs.
- **Secure API Endpoints**
  - All protected routes under `jwt` middleware require valid JWT tokens. For improved security JWT is set into the HttpOnly cookie and not in the JSON response.
  - Permissions can be set per route for granular access control. All routes can have multiple permissions.
  - The `hasActions` Middleware checks for JWT validity and user actions.
  - Additional info for jwt features can be found in jwt.php file in config folder, or in Additional Docs section in this file.
- **Default API Response Facade**
  - The ApiResponse facade registered in the AppServiceProvider provides a common format for the API response using Laravel's Resources feature
  - The DefaultResponseResource is used across the entire app to standarize API response. The ApiResponse facade and ApiResponse service provides an easy-to-switch resource implementation so you can change the implementation of the resource for specific response needs without touching nothing else in the app. Just use your custom resource implementation and make it the response of your ApiResource service. Need custom response formats for development and production environments?, we got you covered. Have different API versions (v1, v2, etc...) with different result formats; no problem. For any of these cases just implement your own resources and build your own api logic in the ApiResponse service.
- **Default Web Access Disabled**
  - Web access to the app is disabled by default. To enable this just modify web.app in routes folder as per your needs.
- **All Laravel Features you Know and Love**
  - The project is entirely based on Laravel 12. All artisan commands are available as usually.

## Getting Started

1. **Clone the repository**
2. **Install dependencies**
   ```sh
   composer install
   ```
3. **Copy environment file and configure**
   ```sh
   cp .env.example .env
   ```
4. **Run migrations**
   ```sh
   php artisan migrate
   ```
5. **Start the server**
   ```sh
   php artisan serve
   ```

## Authentication

All protected routes require a valid JWT token. Use the `/api/{lang}/login` endpoint to obtain a token.

## Notes

- The API is designed for easy extension with new models and controllers.
- All responses vía ApiResponse facade are JSON-formatted for easy frontend integration.

## Additional Docs
The app makes use of `tymon/jwt` and `"spatie/laravel-permission"`. These are the official sites:

- [Tymon/jwt](https://jwt-auth.readthedocs.io/en/develop){:target="_blank"}
- [Spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction){:target="_blank"}