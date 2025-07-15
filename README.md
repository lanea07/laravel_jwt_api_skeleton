# Laravel JWT API Skeleton

A RESTful API application built with Laravel, designed for secure, token-based user authentication and robust resource management. Features a modular Framework architecture that separates core API functionality from business logic.

# Requirements

- PHP >= 8.2
- MySQL or any Laravel compatible DB engine.

## Features

- **Framework Architecture**
  - Organized framework components in dedicated `app/Framework/` directory
  - Clear separation between framework code and business logic
  - Easy to maintain, update, and extend
  - Proper namespacing with `App\Framework\...` structure
- **User Authentication**
  - Registration and login endpoints. (Registration can be removed if not necessary)
  - User logout and profile update functionality. (Profile update can be removed if not necessary)
  - JWT cookie-based authentication for secure access.
  - Custom Cookie lifetime via COOKIE_LIFETIME .env variable.
- **Localization**<br>
  Multilingual support via url.
  - All API routes should contain a `{lang}` parameter. (E.g. {{app_url}}/api/**{version}**/**{lang}**/user-actions)
  - Automatic locale setting via the `setLocale` middleware.
  - Add as many languages as you need to support in your app
- **Role-Based Permissions**
  - Fine-grained access control using custom route permissions. Multiple permissions per route.
- **Modular Route Structure**<br>
  - Grouped routes for user actions and default controller responses. (see api routes)
  - Easy extension for additional modules and controllers. Just create more groups and add any middleware as per your needs.
- **Secure API Endpoints**
  - All protected routes under `jwt` middleware require valid JWT tokens. For improved security JWT is set into the HttpOnly cookie and not in the JSON response.
  - The `hasActions` Middleware checks for JWT validity and user actions.
  - Additional info for jwt features can be found in `jwt.php` file in config folder, or in Additional Docs section in this file.
- **Framework API Response System**
  - The ApiResponse facade from the Framework provides a common format for API responses
  - The ApiResponseFactory class provides easy switching between different API response formats
  - Shared ApiResponseFormatterService for consistent response formatting
- **Default Web Access Disabled**
  - Web access to the app is disabled by default. To enable this just modify `web.php` in routes folder as per your needs.
- **API Version Handling**
  - The API comes with a middleware to help validate API versions. This, along with the ApiResponseFactory feature lets you handle different response formats depending on which API version you are requesting in url. This is an example of a versioned url
  > **{{app_url}}/api/v1/en/default-controller/response**

  Currently the app comes with two api response versions (v1, v2). See `app/Framework/Services` folder for more info.
- **Temporary Tables**
  - A utility service provided to generate temporary tables on-the-go for single use during request processing.
- **Framework Components**
  - **Contracts**: Define interfaces for core functionality
  - **Controllers**: Framework-level controllers (AuthController)
  - **Enums**: HTTP status codes and other enumerations
  - **Exceptions**: Custom exception handling for API requests
  - **Facades**: Easy access to framework services
  - **Factories**: Create appropriate service instances
  - **Middleware**: JWT, localization, permissions, and API versioning
  - **Providers**: Service providers for framework registration
  - **Services**: Core API services (response handling, temp tables)
  - **Traits**: Reusable functionality (permission validation)
  - **ValueObjects**: Immutable data structures
- **All Laravel Features you Know and Love**
  - The project is entirely based on Laravel 12. All artisan commands are available as usually.

## Additional Docs
The app makes use of `tymon/jwt` and `"spatie/laravel-permission"`. These are the official sites:

- [Tymon/jwt](https://jwt-auth.readthedocs.io/en/develop)
- [Spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction)