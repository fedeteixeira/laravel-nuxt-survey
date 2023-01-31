# Set up backend

1. Add the .env file to the backend folder
2. Run `composer install` on the backend folder
3. Run `./vendor/bin/sail up` on the backend folder
4. Run `php artisan key:generate` on the docker laravel container terminal
5. Run `php artisan migrate --seed` on the docker laravel container terminal to seed 10 questions to the database and create an admin user
