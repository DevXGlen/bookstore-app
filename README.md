# Bookstore Library App (PHP Laravel) Setup


### Cloning the Repository

Clone the repository to get a local copy of bookstore library web application built in Laravel web framework.


**Run on your terminal:**

`git clone https://github.com/DevXGlen/bookstore-app.git`


### Navigate into the Newly Created Repository

**Run on your terminal:**

`cd bookstore-app`


### Create Mysql Schema
Create a schema in MySQL Workbench and match it with `DB_DATABASE` variable on your .env


### Configure .env variables
Configure your .env variables 

`APP_URL=http://127.0.0.1:8000`

`DB_DATABASE=<name of schema you've created>`

`FILESYSTEM_DISK=public`


### Install Dependencies 

**Run on your terminal:**

`composer install --ignore-platform-reqs`

`npm install`

### Run Database Migrations

**Run on your terminal:**

`php artisan migrate`


### Public Storage Link
Create a symbolic link from the `public/storage` directory to the `storage/app/public` directory. 

**Run on your terminal:**

`php artisan storage:link`;


### Start Local Development Server
Start local development server and you're good to go!

**Run on your terminal:**

`php artisan serve`