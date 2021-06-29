# [USOF](http://usof.vchkhr.com/)
Service of questions and answers for programmers.

## Features
Lists of [Basic](https://github.com/vchkhr/usof/projects/1) and [Advanced](https://github.com/vchkhr/usof/projects/2) Features.


## Installation
Install needed dependencies:
1. `brew install php mysql composer`.
2. `composer global require laravel/installer`.

Go to project's folder and run:
1. `composer install`.
2. Set up your environment in `.env` file from the `.env.example`. You need to have properly set up Amazon S3 to store images.
3. `php artisan migrate` (you should have an empty `usof` database).
4. To run the server enter: `php artisan serve`.
5. Open `http://127.0.0.1:8000` in your browser.

You can fill database with example data. To do so, do all migrations on empty `usof` database and run `php artisan db:seed`.
