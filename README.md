InfiloreTask - Task Management System

Introduction

This is a simple task management system built with Laravel. It allows an admin to create, edit, assign, and delete tasks, while users can view and update the status of their assigned tasks.

Prerequisites

Before you begin, make sure you have the following installed:

PHP (>= 8.2)

Composer

Laravel

MySQL

A local server XAMPP

Installation Steps

1. Clone the Repository

git clone https://github.com/your-repository/infiloretask.git
cd infiloretask

2. Install Dependencies

composer install

3. Set Up the Environment File

Copy the example .env file:

cp .env.example .env

Open .env and update the database credentials:

DB_DATABASE=infiloretask
DB_USERNAME=root
DB_PASSWORD=

4. Create the Database

Open your browser and go to localhost/phpmyadmin.

Create a new database named infiloretask.

5. Run Migrations

php artisan migrate

6. Seed the Database

php artisan db:seed

7. Start the Server

php artisan serve

Open http://127.0.0.1:8000 in your browser.

Usage

1. Admin Login

Email: admin@gmail.com

Password: password

After logging in, you will be redirected to the Admin Dashboard, where you can:

Add new tasks

Edit existing tasks

Delete tasks

Assign tasks to users

2. Logout as Admin

Click on the Admin Logout button at the top right corner.

3. User Login

Email: user1@gmail.com

Password: password

After logging in, you will be redirected to the User Dashboard, where you can:

View assigned tasks

Update the status of tasks (Pending, In Progress, Completed)

The status update will be reflected on the Admin Dashboard

4. Register as a New User (Optional)

Click on Register and create a new user account.



