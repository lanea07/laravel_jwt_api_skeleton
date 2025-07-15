# Laravel API Framework

This directory contains all custom framework components that provide API response functionality and related utilities for this Laravel template.

## Structure

-   **Contracts/**: Interface definitions for API response services
-   **Controllers/**: Framework controllers (authentication system)
-   **Enums/**: HTTP status code enumerations and other constants
-   **Exceptions/**: Custom exception handlers and exception classes
-   **Facades/**: Laravel facades for easy access to framework services
-   **Factories/**: Factory classes for creating API response services based on version
-   **Middleware/**: HTTP middleware for JWT authentication, API validation, and response formatting
-   **Providers/**: Service providers for framework component registration
-   **Services/**: Core service classes that handle API response formatting and utilities
-   **Traits/**: Reusable traits for common functionality like permission validation
-   **ValueObjects/**: Value object classes for structured data

## Key Features

-   **Version-agnostic response formatting**: Uses header-based detection instead of route inspection
-   **Consistent API responses**: All API endpoints return standardized JSON responses
-   **Centralized logic**: Shared formatting logic reduces code duplication
-   **Extensible**: Easy to add new API versions by implementing the ApiResponseContract

## Usage

The framework automatically detects API requests and formats responses when:

1. The request is for an API route (matches `/v\d+/` pattern)
2. The response includes the `X-API-Formatted` header (set by API response services)

Controllers should use the `ApiResponse` facade:

```php
use App\Framework\Facades\ApiResponse;
use App\Framework\Enums\HttpStatusCodes;

return ApiResponse::sendResponse(
    data: $data,
    message: 'Success message',
    httpCode: HttpStatusCodes::OK_200
);
```

## Adding New API Versions

1. Create a new service class implementing `ApiResponseContract`
2. Update the `ApiResponseFactory` to handle the new version
3. The new service must add the `X-API-Formatted` header manually
