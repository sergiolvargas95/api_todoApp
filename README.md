# 🚀 Personal & Collaborative Task Manager API
This project is a task management API designed for both personal and collaborative use. Developed using PHP with MVC architecture, it provides a structured backend for managing tasks, users, and teams.

### ✨ Features
- **User authentication:** Secure registration and login system.
- **Task management:** Get Create, Update, Delete.
- **Team collaboration:** APIs to manage teams and assign tasks.
- **MVC structure:** Clean and scalable architecture with repositories and services.

### 🛠️ Tech Stack
- **Backend:** PHP (MVC) with repository and service layer architecture.
- **Routing:** bramus/router for clean and efficient route management.
- **Database:** MySQL (or any SQL-based database) for data storage.

### 📌 Status
The API is under active development. Future updates will focus on real-time collaboration using Node.js and the integration of a frontend built with Angular.

## 🚀 What Makes This Project Unique?
This project stands out due to its clean architecture, security-first approach, and scalability-ready design. Below are the key features that make it unique:

### 🏗 Well-Structured MVC Architecture
- Organized into Controllers, Services, Repositories, and Models to ensure maintainability.
- Uses Dependency Injection (DI) for better modularity and testability.
- Implements middleware for request handling and authentication.
  
### 🔐 Secure and Robust Authentication
- Utilizes JWT (JSON Web Tokens) for secure authentication and session management.
- Supports token revocation, ensuring revoked tokens cannot be reused.
- Follows best security practices, including token expiration and proper storage.
  
### ⚡ Efficient and Scalable Design
- Lightweight PHP-based API with bramus/router for route management.
- Clean repository-service pattern for separation of concerns.
- Can be easily extended with additional features due to its modular design.

### 🔌 Seamless Integration and Extensibility
- Designed to integrate with modern frontend frameworks such as Angular or React.
- Well-documented, making it easy for developers to contribute and extend functionality.
  
This project is built for performance, security, and maintainability, making it an ideal foundation for any PHP-based web application. 🚀

## Project Structure
``` 
📦 proyecto
├── 📂 dba
├── 📂 src
│   ├── 📂 config
│   │   ├── 📄 ContainerConfig.php
│   │   ├── 📄 Database.php
│   ├── 📂 controllers
│   │   ├── 📄 AuthController.php
│   │   ├── 📄 CategoryController.php
│   │   ├── 📄 TodoController.php
│   ├── 📂 exceptions
│   │   ├── 📄 UnauthorizedException.php
│   │   ├── 📄 ValidationException.php
│   ├── 📂 factories
│   │   ├── 📄 CategoryFactory.php
│   │   ├── 📄 TodoFactory.php
│   │   ├── 📄 UserFactory.php
│   ├── 📂 interfaces
│   │   ├── 📄 IAuthRepository.php
│   │   ├── 📄 ICategoryRepository.php
│   │   ├── 📄 ITodoRepository.php
│   ├── 📂 middlewares
│   │   ├── 📄 AuthMiddleware.php
│   ├── 📂 models
│   │   ├── 📄 Category.php
│   │   ├── 📄 Todo.php
│   │   ├── 📄 User.php
│   ├── 📂 public
│   │   ├── 📂 images
│   │   ├── 📄 .htaccess
│   │   ├── 📄 index.php
│   ├── 📂 repositories
│   │   ├── 📄 AuthRepository.php
│   │   ├── 📄 CategoryRepository.php
│   │   ├── 📄 TodoRepository.php
│   ├── 📂 routes
│   │   ├── 📄 web.php
│   ├── 📂 services
│   │   ├── 📄 AuthService.php
│   │   ├── 📄 CategoryService.php
│   │   ├── 📄 TodoService.php
│   ├── 📄 bootstrap.php
├── 📂 vendor
├── 📄 .env
├── 📄 .env.example
├── 📄 .gitignore
├── 📄 composer.json
├── 📄 composer.lock
├── 📄 README.md
```
## Main Components

This project follows a modular architecture, organizing different layers to improve maintainability and scalability. Below is a breakdown of the key components of the application:

- 📂 `config/:` Contains essential configuration files.
- 📂 `controllers/:` Handles HTTP requests and contains the business logic.
- 📂 `exceptions/:` Defines custom exceptions for handling specific application errors.
- 📂 `factories/:` Contains factory classes for creating instances of models.
- 📂 `interfaces/:` Defines repository interfaces to maintain abstraction.
- 📂 `middlewares/:` Includes middleware for authentication and security handling:
- 📂`AuthMiddleware.php`: Ensures the user is authenticated before accessing protected routes.
- 📂 `models/:` Represents the domain entities of the application:
- 📂 `public/:` Public directory containing assets and the entry point:
- 📂 `repositories/:` Data access layer responsible for interacting with the database:
- 📂 `routes/:` Defines the application's available routes:
- 📂 `services/:` Contains business logic and application rules:
- 📄 `bootstrap.php:` Initial configuration file to load dependencies and set up the application.
- 📂 `vendor/:` Automatically generated directory by Composer that contains project dependencies.
- 📄 `.env` / `.env.example:` Environment configuration files for managing sensitive variables.
- 📄 `composer.json` / `composer.lock:` Composer configuration files that handle project dependencies.
- 📄 `README.md:` Main documentation file for the repository.

## Databases
This project uses MySQL as the SQL database management system. MySQL works with relational databases, it uses multiple tables that are interconnected with each other to store information and organize it correctly.

### Database Structure

#### 📋 `users`
Stores user information and authentication data.
- `id` (PK): Unique identifier for the user.
- `name`: First name of the user.
- `last_name`: Last name of the user.
- `email`: Email address (unique).
- `password_hash`: Hashed password for authentication.
- `profile_picture`: URL of the user's profile picture.
- `created_at`: Timestamp of account creation.
- `updated_at`: Timestamp of the last update.

#### 🏷️ `categories`
Manages task categories assigned to users.
- `id` (PK): Unique identifier for the category.
- `name`: Category name.
- `color`: Category color (for UI display).
- `user_id` (FK → users.id): Links the category to a specific user.

#### ✅ `todos`
Stores tasks (to-do items) created by users.
- `id` (PK): Unique identifier for the task.
- `title`: Task title.
- `description`: Detailed task description.
- `priority`: Task priority level.
- `status`: Current status of the task.
- `completed`: Boolean flag indicating if the task is completed.
- `created_at`: Timestamp of task creation.
- `updated_at`: Timestamp of the last update.
- `completed_at`: Timestamp when the task was marked as completed.
- `user_id` (FK → users.id): Links the task to a specific user.
- `category_id` (FK → categories.id): Links the task to a category.

#### 🔒 `revoked_tokens`
Manages authentication tokens that have been invalidated.
- `id` (PK): Unique identifier for the revoked token.
- `token`: The invalidated token.
- `revoked_at`: Timestamp when the token was revoked.

### 🔗 Relationships
- Each **user** can have multiple **categories**.
- Each **category** belongs to a single **user**.
- Each **user** can create multiple **to-do tasks**.
- Each **task** is linked to a **category** (optional).
- The **revoked_tokens** table ensures that invalidated authentication tokens cannot be reused.

![image](https://github.com/user-attachments/assets/9d696691-a0f6-4f79-b955-bbfe87fbda03)

This schema ensures efficient task management while maintaining data security and integrity. 🚀

## 🛠️ Installation Guide

Follow the steps below to set up and run the project on your local environment.

### ✅ Prerequisites

Ensure you have the following installed on your system before proceeding:

- **PHP 7.4 or later**  
- **Composer** (Dependency manager for PHP)  
- **Node.js & npm** (Required for real-time event support)  
- **A Web Server** (Apache or Nginx recommended)  
- **A Database Server** (MySQL or PostgreSQL recommended)  

### 📦 Dependencies

This project uses the following PHP libraries:

| Package                     | Description |
|-----------------------------|------------|
| `vlucas/phpdotenv` `^5.6`   | Loads environment variables from a `.env` file. |
| `bramus/router` `^1.6`      | Lightweight routing library for handling requests. |
| `php-di/php-di` `^7.0`      | Dependency injection container for better code organization. |
| `firebase/php-jwt` `^6.11`  | Library for JWT authentication handling. |

### 📥 Installation Steps

1. **Clone the repository**  
 ```sh
 git git@github.com:sergiolvargas95/api_todoApp.git
 cd api_todoApp
 ```
2. Install PHP dependencies
```sh
composer install
```
Set up environment variables
Copy the example environment file and configure it:
```sh
cp .env.example .env
```

