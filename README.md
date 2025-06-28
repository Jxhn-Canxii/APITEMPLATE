# Laravel API Template

A clean and modern Laravel API template with authentication, user management, and CRUD operations.

## Features

- **Authentication**: Register, login, logout with Laravel Sanctum
- **User Management**: Full CRUD operations for users
- **Post Management**: Full CRUD operations for posts with user ownership
- **API Documentation**: Built-in endpoint documentation
- **Clean Architecture**: Organized controllers and models
- **Validation**: Comprehensive request validation
- **Error Handling**: Consistent error responses

## Requirements

- PHP >= 8.1
- Laravel >= 10.0
- MySQL/PostgreSQL/SQLite
- Composer

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd APITEMPLATE
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   Update your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/register` | Register a new user | No |
| POST | `/api/login` | Login user | No |
| POST | `/api/logout` | Logout user | Yes |
| GET | `/api/user` | Get current user | Yes |

### Users

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/users` | Get all users | Yes |
| POST | `/api/users` | Create a new user | Yes |
| GET | `/api/users/{id}` | Get specific user | Yes |
| PUT | `/api/users/{id}` | Update user | Yes |
| DELETE | `/api/users/{id}` | Delete user | Yes |

### Posts

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/posts` | Get all posts | Yes |
| POST | `/api/posts` | Create a new post | Yes |
| GET | `/api/posts/{id}` | Get specific post | Yes |
| PUT | `/api/posts/{id}` | Update post | Yes |
| DELETE | `/api/posts/{id}` | Delete post | Yes |
| GET | `/api/my-posts` | Get current user posts | Yes |

### Health Check

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/api/health` | Health check endpoint | No |

## Usage Examples

### Register a new user
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Create a post (with authentication)
```bash
curl -X POST http://localhost:8000/api/posts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "title": "My First Post",
    "content": "This is the content of my first post.",
    "status": "published"
  }'
```

### Get all posts
```bash
curl -X GET http://localhost:8000/api/posts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Response Format

All API responses follow a consistent format:

### Success Response
```json
{
  "status": true,
  "message": "Operation successful",
  "data": {
    // Response data here
  }
}
```

### Error Response
```json
{
  "status": false,
  "message": "Error message",
  "errors": {
    // Validation errors (if any)
  }
}
```

## Authentication

This API uses Laravel Sanctum for authentication. To access protected endpoints:

1. Register or login to get a token
2. Include the token in the Authorization header:
   ```
   Authorization: Bearer YOUR_TOKEN_HERE
   ```

## Database Structure

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - User's email (unique)
- `password` - Hashed password
- `email_verified_at` - Email verification timestamp
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

### Posts Table
- `id` - Primary key
- `title` - Post title
- `content` - Post content
- `user_id` - Foreign key to users table
- `status` - Post status (draft/published)
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please open an issue in the repository or contact the development team.
