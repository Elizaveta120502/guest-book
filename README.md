# Guest Book Application

This is a simple Guest Book application built using Laravel. It allows users to register, log in, add reviews, and admins to respond to reviews. The application uses Laravel Sanctum for authentication and API routes for communication.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Elizaveta120502/guest-book.git

 2.  **Install dependencies:**
```bash
     docker-compose up -d
     docker-compose exec app composer install
```
3. **Set up environment variables:**

```bash
 cp .env.example .env
```
4. **Run migrations and seeders:**
```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```
