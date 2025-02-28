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
