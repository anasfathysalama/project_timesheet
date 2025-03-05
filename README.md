# Time Tracking API

A Laravel-based Restfull API for project time tracking with dynamic attributes support.


## Requirements

- PHP 8.1+
- Laravel 10.0+


## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/anasfathysalama/project_timesheet.git
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Set up environment variables
   ```bash
   cp .env.example .env
   # Edit .env file with your database credentials
   ```
   
4. Generate application key
   ```bash
   php artisan key:generate
   ```

5. Run migrations and seeders
   ```bash
   php artisan migrate --seed
   ```

6. Install Passport
   ```bash
   php artisan passport:install
   ```

7. Start the server
   ```bash
   php artisan serve
   ```

## Test Credentials

You can use the following credentials to test the API:

- Email: test@test.test
- Password: 123456


### API documentation

Can check the Postman documentation which includes all API endpoints with examples:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://documenter.getpostman.com/view/10076766/2sAYdkGogU)

