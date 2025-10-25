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
2. Set up the database using the provided schema.
3. Configure database credentials in `config.php`.
4. Start a local server and navigate to the project directory.
