# Laravel Event Management System

## Description
Manage events, registrations, approvals, and attendee views with calendar and email notifications.

## Features
- Laravel 12 with Breeze
- Organizer/Admin roles
- Event creation and registration
- FullCalendar view
- Email notifications
- Tailwind UI

## Setup
```bash
git clone <repo>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve


Login Roles

admin@example.com / password
organizer@example.com / password
attendee@example.com / password

Template Credit
Calendar: FullCalendar.io