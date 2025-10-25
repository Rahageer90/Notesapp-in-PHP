# Notes Application

A full-featured notes and todo list application built with PHP and MySQL, following MVC architecture. The application is hosted at [notesapp-in-php.onrender.com](https://notesapp-in-php.onrender.com).

## Features

### Authentication
- Google OAuth integration for secure login
- Session-based authentication system
- Protected routes for authenticated users

### Notes Management
- Create, read, update, and delete personal notes
- Toggle notes between private and public visibility
- Dashboard with pagination (5/10/15 notes per page)
- Sort notes by:
  - Newest first
  - Oldest first
  - Alphabetically
- Bulk delete functionality
- Public notes section showing notes from all users

### Todo List
- Personal todo list management
- Create, edit, and delete todo items
- Mark items as complete/incomplete
- Separate views for pending and completed tasks

### Technical Features
- MVC architectural pattern
- PDO for database operations
- Tailwind CSS for responsive design
- Docker support for containerization

## Installation

1. Clone the repository:
```sh
git clone <repository-url>
cd notesapp-in-php
```

2. Install dependencies:
```sh
composer install
```

3. Configure environment variables:
   - Copy `.env.example` to `.env`
   - Update database credentials
   - Add Google OAuth credentials

4. Set up the database:
```sql
CREATE DATABASE notesapp;
USE notesapp;
// Import schema from notes.sql
```

5. Start the application:
```sh
php -S localhost:8000
```

## Docker Deployment

1. Build the Docker image:
```sh
docker build -t notesapp .
```

2. Run the container:
```sh
docker run -p 80:80 notesapp
```

## Project Structure
```
├── controllers/    # Application controllers
├── Core/          # Core framework files
├── models/        # Data models
├── views/         # View templates
├── config.php     # Configuration
├── database.php   # Database connection
└── route.php      # URL routing
```

## Environment Requirements
- PHP 8.1+
- MySQL 5.7+
- Apache/Nginx
- Composer

## Live Demo
Visit [notesapp-in-php.onrender.com](https://notesapp-in-php.onrender.com) to see the application in action.

## License
MIT License

## Author
Rahageer Saadman Islam