# [USOF](http://usof.vchkhr.com/)
Service of questions and answers for programmers.

## Features
Basic features:
- Account: create, email confirmation, log in, log out, reset password, delete (with all content).
- Profile: create (profile photo, name, description, web-site, rating, is admin), see all, update data.
- Question: create (title, description, image, tags), see all, update (all data, set as solved/unsolved), delete.
- Tag: see all.
- Answer: create (description, image, is correct), see all, update (all data, set as correct/incorrect), delete.
- Like/dislike: create (only one per user for each question and answer), see all, delete.
- Search (among title and description of questions and answers);
- The admin can update user data.
- Sort and filter questions (todo).

Extra features:
- Additional info for profile (description, web-site).
- Favorites (todo).
- Welcome page (todo).
- Share on social networks (todo).
- Reactions (todo).
- Footer (todo).
- Profile Statistics.
- Awards (todo).
- Dark theme (todo).
- Email notifications on new answers (todo).
- Profile's site, unsecure external website.
- Admin can mark questions as solved and select best answer.
- Admin can delete questions and answers.
- Number of views (todo).


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
