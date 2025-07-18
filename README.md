# Laravel Event Management System

# Group 15 Members

- Student 1: Laeeqah Arendse - 230055923

## Description
Manage events, registrations, approvals, and attendee views with calendar and email notifications.

## Features

### Authentication & Roles (Laravel Breeze)
- Registration & Login
- Roles: Admin, Organizer, Attendee
- Role-based access using Laravel Policies

### Event Management
- Create, edit, delete events
- View events on a calendar
- Approve or decline event registrations
- Email notifications for event updates

### Attendee Management
- Register for events
- View registration status
- Receive email notifications

### Tech Stack
- Framework: Laravel 12+
- Frontend: Blade Templates + Bootstrap 5
- Authentication: Laravel Breeze
- Database: MySQL
- Mail Driver: Mailtrap (or Laravel's log driver for local dev)
- **Version Control:** GitHub

---

## Installation Guide (XAMPP)

### Prerequisites

- PHP 8.2+
- Composer
- XAMPP (Apache + MySQL)
- Git (optional)

### Steps

1. Clone the Repository:
   ```bash
   git clone https://github.com/your-username/event_management_system.git
   cd event_management_system

2. Install Dependencies:
    ```bash
	composer install
	npm install
	npm run build

4. Copy .env File:
    ```bash
	cp .env.example .env
6. Set Up .env:
	```env
	APP_NAME=Laravel
	APP_ENV=local
	APP_KEY=base64:xPl37k9/mF+8pEUOjjU/n1oS5LSbI3+tOKjqrVo4S+E=
	APP_DEBUG=true
	APP_URL=http://localhost/event_management_system

	Update database and mail credentials:
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3307
	DB_DATABASE=ems_db
	DB_USERNAME=root
	DB_PASSWORD=

	MAIL_MAILER=log
	MAIL_SCHEME=null
	MAIL_HOST=127.0.0.1
	MAIL_PORT=2525
	MAIL_USERNAME=null
	MAIL_PASSWORD=null
	MAIL_FROM_ADDRESS="hello@example.com"
	MAIL_FROM_NAME="${APP_NAME}"


7. Generate Key & Migrate Database:
   ```bash
	php artisan key:generate
	php artisan migrate --seed

9. Access the App:
	Visit http://localhost/event_management_system/public/login in your browser.


## Database Schema
- Users Table (Admin, Organizer, Attendee roles)
- Events Table (title, description, date, location)
- Registrations Table (event_id, user_id, status)
- Roles & Permissions (handled by Laravel Policies)

## How to Use
- As an Admin: Manage users and approve event registrations.
- As an Organizer: Create and manage your own events.
- As an Attendee: View upcoming events, register, and track approvals.


Test Login Roles

- admin@example.com / password123  (admin)
- laeeqah.arendse@icloud.com / Laeeqah123 (attendee)
- nadiaarendse@gmail.com / Nadia123 (organiser)

Template Credit
Calendar: FullCalendar.io
