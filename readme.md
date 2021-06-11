Install needed dependencies:
1. `brew install php mysql composer`.
2. `composer global require laravel/installer`.

Go to project's folder and run:
1. `composer install`.
2. Set up your environment in `.env` file from the `.env.example`.
3. `php artisan migrate` (you should have an empty `usof` database).

To run the server enter:
`php artisan serve`.

Go to `http://127.0.0.1:8000` in your browser.

You can fill database with example data. To do so, create empty `usof` database and run `php artisan db:seed`.

You may need to run `php artisan storage:link` to properly work with images.
