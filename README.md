# User DB

----------

# Getting started


## Installation
Clone the repository

    git clone git@github.com:1BBC/user-db.git

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Start the local development server

    php artisan serve

Install the dependencies for the front part

    npm install

Start the local watcher

    npm run dev

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## Api methods

The front end uses these methods to communicate with the backend

| Method | URL                   | Description             |
|--------|-----------------------|-------------------------|
| `GET`  | `/api/v1/users`       | Retrieve all users.     |
| `POST` | `/api/v1/users`       | Create a new user.      |
| `GET`  | `/api/v1/users/28`    | Retrieve user #28.      |
| `GET`  | `/api/v1/token`       | Retrieve token          |
| `GET`  | `/api/v1/positions`   | Retrieve all positions. |

## Application testing
Copy the example env file and make the required configuration changes in the .env.testing file

    cp .env.testing.example .env.testing

Start testing

    php artisan test
