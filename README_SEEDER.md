# Thanh Thanh Tùng Stone Seeder

This seeder populates the database with data based on the Thanh Thanh Tùng Stone website (https://thanhthanhtungstone.com.vn/).

## Database Setup

Before running the seeder, make sure you have:

1. MySQL server running on your machine
2. Created a MySQL database named `thanhthanhtung` (or update the database name in the scripts)
3. Set up your database credentials in the `.env` file or in the scripts

### Creating the Database

You can use the provided script to create the database:

```bash
php create_database.php
```

This script will:
- Check if the database exists
- Create it if it doesn't exist
- Use the following default configuration:
  - Host: 127.0.0.1
  - Port: 3306
  - Username: root
  - Password: (empty)
  - Database: thanhthanhtung

If you need to use different credentials, edit the variables at the top of the `create_database.php` file.

## Running Migrations

After creating the database, run the migrations:

```bash
php artisan migrate
```

## Running the Seeder

There are multiple ways to run the seeder:

### Option 1: Using the Custom Command

```bash
php artisan seed:thanhthanhtung
```

### Option 2: Using the Database Seeder

```bash
php artisan db:seed --class=ThanhThanhTungStoneSeeder
```

### Option 3: Using the Custom Script

```bash
php run_seeder.php
```

To run migrations before seeding:

```bash
php run_seeder.php --migrate
```

## Complete Setup in One Command

To set up everything in one go:

```bash
php create_database.php && php artisan migrate && php artisan db:seed --class=ThanhThanhTungStoneSeeder
```

## Seeded Data

The seeder will populate the following tables:

- `stone_categories`: Different types of stone (Marble, Granite, etc.)
- `stone_materials`: Stone materials (Natural, Artificial)
- `stone_colors`: Stone colors (White, Black, Gray, etc.)
- `stone_surfaces`: Stone surface finishes (Polished, Matte, etc.)
- `stone_applications`: Stone applications (Kitchen countertops, Wall cladding, etc.)
- `stone_showrooms`: Showroom locations (Da Nang, Hanoi, Ho Chi Minh)
- `stone_projects`: Sample projects
- `stone_products`: Sample stone products
- `stone_product_images`: Images for the stone products
- `stone_videos`: Sample videos

## Customizing the Seeder

To add more data or modify the existing data:

1. Open `database/seeders/ThanhThanhTungStoneSeeder.php`
2. Add or modify the arrays of data for each table
3. Run the seeder again

## Troubleshooting

If you encounter any issues:

1. Check your database connection settings
2. Ensure all required tables exist in the database (run migrations if needed)
3. Check for any error messages in the output

If you see "Class not found" errors, make sure to run:

```bash
composer dump-autoload
``` 