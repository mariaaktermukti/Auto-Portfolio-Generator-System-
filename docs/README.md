# Auto-Portfolio-Generator-System

A simple PHP-based portfolio management system with user authentication.

## Quick Start

1. **Start XAMPP**: Open XAMPP Control Panel and start Apache + MySQL
2. **Import Database**: Open phpMyAdmin → SQL tab → Run `docs/portfolio_gen.sql`
3. **Login**: Use your registered credentials

## Project Structure

```
.
├── public/                 # Entry points (index.php, login.php, register.php, etc.)
├── config/                 # Database & config files
├── src/                    # Core application logic (auth, database classes)
│   ├── Auth/              # Authentication logic
│   └── Database/          # Database utilities
├── assets/                 # Static files
│   ├── css/               # Stylesheets
│   └── img/               # Images
└── docs/                   # Documentation & database schema
```

## Features

- User Registration & Login
- Password hashing
- Session management
- Dashboard

## Requirements

- PHP 7.0+
- MySQL 5.7+
- Apache (XAMPP)

