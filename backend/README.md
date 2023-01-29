# Set up backend

1. Add the .env file to the backend folder
2. Run `composer install` on the backend folder
3. Run `./vendor/bin/sail up`
4. Run `php artisan key:generate` on the docker laravel container terminal
5. Run `php artisan db:seed --class=QuestionsTableSeeder` to seed 10 questions to the database
