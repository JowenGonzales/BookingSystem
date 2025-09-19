# Staff Booking & Analytics System

A Laravel-based web application for staff to manage bookings, track payments, and view analytics reports with charts and KPIs.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Dependencies](#dependencies)

---

## Features

- **Booking Management**
    - Create, edit, view, and delete bookings
    - Track booking status: pending, confirmed, completed, cancelled
    - Assign payments to bookings (cash, GCash, credit)

- **Payment Tracking**
    - Record paid/unpaid bookings
    - Calculate total revenue, cash revenue, and payment conversion

- **Analytics Dashboard**
    - Filterable date ranges
    - KPIs: total bookings, confirmed/completed/cancelled bookings, unpaid bookings, cash revenue, payment conversion
    - Charts:
        - Bookings per day
        - Revenue per day
        - Top services by bookings

- **Staff Management**
    - Staff authentication
    - Role-based access (admin/staff)

---

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/booking-analytics.git
cd booking-system
```

2. Install Dependencies
```bash
composer install
npm install
```

## Configuration
1. Copy the .env file and set your environment variables:
```bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking-system
DB_USERNAME=root
DB_PASSWORD=your_password

```

## Database Setup

1. Run Migrations
```
php artisan migrate
```
2. Seed the database with test data
```
php artisan db:seed
```

3. Seed the database with more test data (optional)
Uncomment the next line in ``booking-system/database/seeders/DatabaseSeeder.php``
```php
$this->call([
    UserSeeder::class,

    // Uncomment this if you want to seed the database with more data
    // AnalyticsSeeder::class,
]);
```


## Usage
Start the Laravel development server:
```
php artisan serve
```

By default, it will run at:
```cpp
http://127.0.0.1:8000
```

Open this URL in your browser to access the app. Staff panel:
```cpp
http://127.0.0.1:8000/staff
```

## Dependencies
Laravel 10

1. PHP >= 8.1
2. MySQL or compatible database
3. Bootstrap 5 (for UI)
4. Chart.js (optional, for charts)
5. Font Awesome (icons)
