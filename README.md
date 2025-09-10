<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🎉 Event Management Backend

This is the **Laravel API backend** for the Mini Event Management System.  
It provides endpoints to create events, register attendees, and fetch attendee lists, with validation for overbooking and duplicate registrations.

---

## 🚀 Features
- Create new events with details (name, location, time, capacity)  
- List all upcoming events  
- Register attendees with validation (no duplicates, no overbooking)  
- View attendees of an event  
- Built with **Laravel** + **PostgreSQL**  
- Clean architecture (Models, Controllers, Services)  
- Timezone-aware event scheduling

---

## 📦 Requirements
- PHP >= 8.1  
- Composer  
- Laravel >= 10  
- PostgreSQL

---

## ⚙️ Setup Instructions

```bash
# Clone repository
git clone https://github.com/YOUR_USERNAME/event-management-backend.git
cd event-management-backend

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Set database in .env
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=event_management
# DB_USERNAME=your_user
# DB_PASSWORD=your_password

# Run database migrations
php artisan migrate

# Start server
php artisan serve


---

## 🌐 Frontend Repository

The frontend for this Event Management System is hosted separately.  
You can find it here:

[Event Management Frontend](https://github.com/Arthanarieswaran/event_management_frontend.git)

### 🔹 Setup Instructions (Frontend)
