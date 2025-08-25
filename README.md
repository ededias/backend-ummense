# User API

A RESTful API for managing users built with Laravel.

## 🚀 Getting Started

### Prerequisites

- Docker
- Docker Compose

### Installation

1. Clone the repository
```bash
git clone [<repository-url>](https://github.com/ededias/backend-ummense.git)
cd backend-ummense

```

2. Start the application using Docker
```bash
docker compose up -d --build
```

The API will be available at `http://localhost:8000` (or your configured port).

## 📋 API Endpoints

### Base URL
```
http://localhost:8000/api/users
```

### Endpoints Overview

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/`      | Get all users |
| GET    | `/{id}`  | Get user by ID |
| POST   | `/`      | Create new user |
| PUT    | `/{id}`  | Update user by ID |
| DELETE | `/{id}`  | Delete user by ID |

---

## 📝 API Documentation

### 1. Get All Users
```http
GET /
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Test Test",
    "email": "test@gmail.com",
    "password": null
  }
]
```

### 2. Get User by ID
```http
GET /{id}
```

**Parameters:**
- `id` (integer, required) - User ID

**Response:**
```json
{
  "id": 1,
  "name": "Test test",
  "email": "test@gmail.com",
  "password": null
}
```

### 3. Create New User
```http
POST /
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
  "message": "User created successfully",
  "status": "user_created"
}
```

### 4. Update User
```http
PUT /{id}
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
  "message": "User updated successfully",
  "status": "user_updated"
}
```

### 5. Delete User
```http
DELETE /{id}
```

**Parameters:**
- `id` (integer, required) - User ID

**Response:**
```json
{
  "message": "User deleted successfully",
  "status": "user_deleted"
}
```

## 📊 HTTP Status Codes

| Status Code | Description |
|-------------|-------------|
| 200 | OK - Request successful |
| 201 | Created - User created successfully |
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

**Get all users:**
```bash
curl -X GET http://localhost:8000/api/users
```

**Create a user:**
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{
    "name": Test test",
    "email": "test@gmail.com",
    "password": "123456"
  }'
```

**Update a user:**
```bash
curl -X PUT http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test Updated",
    "email": "test.updated@gmail.com"
  }'
```

**Delete a user:**
```bash
curl -X DELETE http://localhost:8000/api/users/1
```

### Running Tests
```bash
docker compose exec app php artisan test
```

### Stopping the Application
```bash
docker compose down
```

## 📝 Notes

- All endpoints expect and return JSON data
- Make sure to set `Content-Type: application/json` header for POST and PUT requests
- Passwords are automatically hashed when creating or updating users
- Email addresses must be unique in the system
