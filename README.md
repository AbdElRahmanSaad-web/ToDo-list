<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# To-Do List Application

This is a simple To-Do List application. The application allows users to register, log in, and manage their to-do items. It includes CRUD functionality, user authentication, and a responsive user interface.

## Features

- User registration and login
- Create, read, update, and delete (CRUD) to-do items
- Each to-do item has a title, description, due date, and status (pending or completed)
- Responsive and user-friendly UI using Blade templates
- Optional features: filtering and sorting of to-do items, user profile management

## Technologies Used

- Backend: Laravel
- Frontend: Blade templates, Bootstrap, CSS, javascript, jQuery
- Database: MySQL

## Installation

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL

### Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/todo-list-app.git
   cd todo-list-app

2. Install backend dependencies

composer install

3. Copy the .env.example file to .env

cp .env.example .env

4. Generate an application key

php artisan key:generate

5. set up the database
    Create a new MySQL database for the project.
    Update the .env file with your database credentials


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password


6. Run database migrations

php artisan migrate

7. Start the local development server

php artisan serve

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
