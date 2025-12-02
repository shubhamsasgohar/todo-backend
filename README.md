Todo List API — Laravel Backend

This project is the backend API for a Todo List application built with Laravel 12 and MySQL.
It provides complete CRUD functionality along with PDF file upload support.

This backend is used by the Next.js frontend of the Todo App.

Features

✔ Create Task (with optional PDF upload)

✔ View All Tasks

✔ View Single Task

✔ Update Task (including replacing PDF)

✔ Delete Task

✔ Handles file storage securely

✔ RESTful JSON API

| Layer        | Technology                    |
| ------------ | ----------------------------- |
| Backend      | Laravel 12                    |
| Database     | MySQL                         |
| File Uploads | Laravel Storage (public disk) |
| API Format   | JSON                          |

⚙️ Installation & Setup

Follow the steps below to set up the backend locally.

1️⃣ Install Dependencies
composer install

2️⃣ Environment Setup

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_db       # change as needed
DB_USERNAME=root          # your MySQL user
DB_PASSWORD=              # your MySQL password

3️⃣ Generate App Key
php artisan key:generate

4️⃣ Run Database Migrations

5️⃣ Set Storage Permissions
php artisan storage:link

This allows serving uploaded PDFs via:
/storage/<filename>

6️⃣ Start the Development Server
php artisan serve

Your API will be available at:
http://127.0.0.1:8000/api


📡 API Endpoints
Get all tasks
GET /api/todos

Get a single task
GET /api/todos/{id}

Create a task
POST /api/todos

Body (multipart/form-data):

title — string
details — string (optional)
file — PDF file (optional)

Update a task
POST /api/todos/{id}
Body (multipart/form-data):

Same as create
Optional new PDF replaces old one


Delete a task
DELETE /api/todos/{id}


🧪 Testing the API

You can use:
Postman
Thunder Client (VS Code)

Remember to send multipart/form-data for file uploads.


