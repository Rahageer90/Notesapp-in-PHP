# NotesApp

A simple yet powerful notes application built using PHP and MySQL, following the MVC architecture.

## Features

### Authentication
- User login and registration.
- Session-based authentication.
- Authorization checks for private data.

### Notes Management
- Create, edit, and delete personal notes.
- View all created notes on a dashboard.
- Pagination with adjustable notes per page (5, 10, 15).
- Sorting options: newest, oldest, and alphabetical order.
- Bulk deletion of selected notes.
- Public Notes page displaying notes from all users (with creator’s email).

### To-Do List
- Private to-do list feature visible only to the logged-in user.
- CRUD operations for to-do items.
- Tasks categorized as "works to be done" and "works done."
- Checkbox functionality to move tasks between categories.

### UI & Styling
- Responsive design using Tailwind CSS.
- Navigation bar with links to dashboard, public notes, and to-do list.
- Footer that stays at the bottom of all pages.

### Database & Backend
- Secure MySQL database connection with PDO.
- MVC structure for cleaner code organization.
- Dynamic routing system with GET, POST, PUT, and DELETE support.

## Installation
1. Clone the repository:
2. Set up the database using the provided schema.
3. Configure database credentials in `config.php`.
4. Start a local server and navigate to the project directory.
