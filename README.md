# Translation Management Service

## Objective
Build a Translation Management Service to evaluate clean, scalable, and secure code with a focus on performance.

## Task
Develop an API-driven service with the following features:

### Performance Requirements
- Response time for all endpoints should be in milliseconds (i.e., < 200ms).
- The JSON export endpoint should efficiently handle large datasets and return responses in less than 500ms.
- Provide a command or factory to populate the database with 100k+ records for testing scalability.

### Technical Requirements
- Store translations for multiple locales (e.g., `en`, `fr`, `es`) with support for adding new languages.
- Tag translations for context (e.g., `mobile`, `desktop`, `web`).
- Expose endpoints to create, update, view, and search translations by tags, keys, or content.
- Provide a JSON export endpoint for frontend applications.
- Ensure the JSON endpoint always returns updated translations.
- Follow PSR-12 standards and use a scalable database schema.
- Follow SOLID design principles.

## API Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/api/translations` | Create a new translation |
| `PUT` | `/api/translations/{id}` | Update an existing translation |
| `GET` | `/api/translations` | View translations |
| `GET` | `/api/translations/search` | Search translations |
| `GET` | `/api/export` | Export translations as JSON |

## Installation
```sh
git clone <repository_url>
cd translation-management-service
composer install
cp .env.example .env
php artisan migrate --seed
php artisan serve
```

## Running Tests
```sh
php artisan test
```

## Security
- **Authentication:** Token-based authentication.
- **Input Validation:** Prevent injection attacks.
- **Rate Limiting:** Prevent API abuse.

## Performance Optimization
- Use indexed database columns.
- Cache frequently accessed translations.
- Optimize query execution plans.

