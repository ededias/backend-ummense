# User API

A RESTful API for managing users built with Laravel.

## 🚀 Getting Started

### Prerequisites

- Docker
- Docker Compose

### Installation

1. Clone the repository
```bash
git clone https://github.com/ededias/backend-ummense.git
cd backend-ummense
```

2. Start the application using Docker
```bash
docker compose up -d --build
```

5. to to run migrations
```bash
docker exec -it laravel_app php artisan migrate
```

5. to create admin user and uses the api
```bash
docker exec -it laravel_app php artisan db:seed
```

The API will be available at `http://localhost:8000` (or your configured port).

## 📋 API Endpoints

### Base URL
```
http://localhost:8000/api
```

### Authentication Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST   | `/login` | User authentication |

### User Management Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/users` | Get all users |
| GET    | `/users/{id}` | Get user by ID |
| POST   | `/users` | Create new user |
| PUT    | `/users/{id}` | Update user by ID |
| DELETE | `/users/{id}` | Delete user by ID |

---

## 📝 API Documentation

### Authentication

#### 1. User Login
```http
POST /login
```

**Request Body:**
```json
{
  "email": "test@gmail.com",
  "password": "123456"
}
```

**Required Fields:**
- `email` (string) - User's email address
- `password` (string) - User's password

**Success Response:**
```json
{
  "token": "1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930"
}
```

**Error Response (Invalid Credentials):**
```json
{
  "message": "Invalid credentials"
}
```

---

### User Management

⚠️ **Note:** All user management endpoints require authentication. Include the token in the Authorization header:
```
Authorization: Bearer 1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930
```

#### 1. Get All Users
```http
GET /users
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Test test",
    "email": "test@gmail.com",
    "password: null,
  }
]
```

#### 2. Get User by ID
```http
GET /users/{id}
```

**Parameters:**
- `id` (integer, required) - User ID

**Response:**
```json
{
   "id": 1,
   "name": "Test test",
   "email": "test@gmail.com",
   "password: null,
}
```

#### 3. Create New User
```http
POST /users
```

**Request Body:**
```json
{
  "name": "Test test",
  "email": "test@gmail.com",
  "password": "123456"
}
```

**Required Fields:**
- `name` (string) - User's full name
- `email` (string) - User's email address
- `password` (string) - User's password

**Response:**
```json
{
  "id": 1,
  "name": "Test test",
  "email": "test@gmail.com",
  "password: null,
}
```

#### 4. Update User
```http
PUT /users/{id}
```

**Parameters:**
- `id` (integer, required) - User ID

**Request Body:**
```json
{
  "name": "Edenilson",
  "email": "edenilson@gmail.com",
  "password": "123456"
}
```

**Fields (all optional for update):**
- `name` (string) - User's full name
- `email` (string) - User's email address
- `password` (string) - User's password

**Response:**
```json
{
  "id": 1,
  "name": "Edenilson",
  "email": "edenilson@gmail.com",
  "password": null
}
```

#### 5. Delete User
```http
DELETE /users/{id}
```

**Parameters:**
- `id` (integer, required) - User ID

**Response:**
```json
{
  "message": "User deleted successfully"
}
```

## 📊 HTTP Status Codes

| Status Code | Description |
|-------------|-------------|
| 200 | OK - Request successful |
| 201 | Created - User created successfully |
| 401 | Unauthorized - Invalid or missing authentication token |
| 404 | Not Found - User not found |
| 422 | Unprocessable Entity - Validation errors |
| 500 | Internal Server Error |

## 🔧 Error Response Format

```json
{
  "error": "Error message",
  "details": "Detailed error information"
}
```

## 📋 Example Usage

### Using cURL

**Login:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "edenilson@gmail.com",
    "password": "123456"
  }'
```

**Get all users (with authentication):**
```bash
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer 1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930"
```

**Create a user (with authentication):**
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer 1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930" \
  -d '{
    "name": "Test test",
    "email": "test@gmail.com",
    "password": "123456"
  }'
```

**Update a user (with authentication):**
```bash
curl -X PUT http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer 1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930" \
  -d '{
    "name": "test Updated",
    "email": "test.updated@gmail.com"
  }'
```

**Delete a user (with authentication):**
```bash
curl -X DELETE http://localhost:8000/api/users/1 \
  -H "Authorization: Bearer 1|5Hnb5goj8IvQXCPDqxazmwbQMgAO9k1hPxJJxp2Z50f7e930"
```


### Running Tests
```bash
docker exec -it laravel_app php artisan test
```

### Stopping the Application
```bash
docker compose down
```

## 📝 Notes

- The API uses token-based authentication (likely Laravel Sanctum)
- Login first to get an authentication token
- Include the token in the `Authorization: Bearer {token}` header for all user management requests
- All endpoints expect and return JSON data
- Make sure to set `Content-Type: application/json` header for POST and PUT requests
- Passwords are automatically hashed when creating or updating users
- Email addresses must be unique in the system
- Tokens don't expire automatically but can be revoked
