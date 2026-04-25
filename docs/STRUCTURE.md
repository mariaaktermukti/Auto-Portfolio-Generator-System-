# Project Structure Guide

## 📁 Directory Layout

```
Auto Portfolio Generator System/
│
├── public/                          # 🌐 Web root (entry points)
│   ├── index.php                   # Router
│   ├── login.php                   # Login page
│   ├── register.php                # Registration page
│   ├── dashboard.php               # User dashboard
│   └── logout.php                  # Logout handler
│
├── config/                          # ⚙️ Configuration
│   └── config.php                  # Database connection & constants
│
├── src/                             # 📦 Application Source Code
│   ├── Auth/                       # Authentication logic
│   │   └── AuthHandler.php        # (Future) Login/Register logic class
│   └── Database/                   # Database utilities
│       └── Database.php            # (Future) Query builder / PDO wrapper
│
├── assets/                          # 🎨 Static Resources
│   ├── css/
│   │   └── style.css               # Stylesheet
│   └── img/                         # Images & screenshots
│
├── docs/                            # 📚 Documentation
│   ├── README.md                   # Project overview
│   ├── db.sql                       # Database schema
│   └── STRUCTURE.md                # This file
│
├── .htaccess                        # 🔄 URL rewriting rules
├── .git/                            # Git repository
└── .gitignore                       # Git exclusions
```

## 🎯 How to Use Each Directory

### `/public`
- **Purpose**: Web-accessible entry point
- **Contains**: All `.php` pages users access
- **Note**: Update references to `../config/` and `../assets/` when including files

### `/config`
- **Purpose**: Centralized configuration
- **Contains**: Database connection, constants, settings
- **Security**: Never expose this directory via web; keep outside `public/` folder

### `/src`
- **Purpose**: Reusable application logic (classes, utilities)
- **Structure**:
  - `Auth/` → User authentication, password hashing, session management
  - `Database/` → Query utilities, prepared statements, connection pooling
- **Future**: Add more utilities as project grows (validation, email, helpers, etc.)

### `/assets`
- **Purpose**: Static front-end resources
- **Subdirectories**:
  - `css/` → All stylesheets
  - `img/` → All images
  - Can add: `js/`, `fonts/`, `vendor/` as needed

### `/docs`
- **Purpose**: Documentation & database management
- **Contains**:
  - `README.md` → Getting started guide
  - `db.sql` → Database schema for import
  - `STRUCTURE.md` → This structure guide

## 📝 Best Practices

1. **Always use relative paths** from the entry point:
   ```php
   require '../config/config.php';
   require '../src/Auth/AuthHandler.php';
   <link href="../assets/css/style.css" rel="stylesheet">
   ```

2. **Keep business logic in `/src`**: Move validation, DB queries, auth logic out of page files

3. **Add new utilities in `/src`**:
   - Validation: `src/Validation/Validator.php`
   - Email: `src/Email/Mailer.php`
   - Helpers: `src/Helpers/String.php`

4. **Use `.htaccess`** for clean URLs (already configured)

## 🔄 Migration from Old Structure

Old files moved:
- `config.php` → `config/config.php`
- `style.css` → `assets/css/style.css`
- `index.php` → `public/index.php`
- `login.php` → `public/login.php` (updated require path)
- `register.php` → `public/register.php` (updated require path)
- `dashboard.php` → `public/dashboard.php` (updated require path)
- `logout.php` → `public/logout.php`
- `db.sql` → `docs/db.sql`
- `README.md` → `docs/README.md`

Old `Features/` folder can now be deleted.

## 🚀 Next Steps

1. Create classes in `/src/Auth/` and `/src/Database/`
2. Refactor page logic into these classes
3. Add validation classes in `/src/Validation/`
4. Add error handling middleware
5. Add environment configuration (`.env` support)

