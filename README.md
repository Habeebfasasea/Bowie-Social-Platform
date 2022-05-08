# Bowie Social Platform
Bowie Social Platform is a proposed Bowie State University software solution that allows the university departments share informational posts across social media platforms. This project was built with Laravel and it also uses a package called "jorenvanhocht/laravel-share" to share posts by departments.

## Basic Functionalities
* There is a Head Department that approves the creation of new departments.
* The Head department is also known as the Relations Department.
* The Head department can approve or reject informational posts by the existing department.
* The Head department can also delete/remove an existing department from the application.
* Only posts approved by the head department can be shared across Social media platforms.

# Usage
## Database Setup
This web application uses MySQL database.

To use MySQL database, make sure you install it, setup a database and then add your db credentials(database, username and password) to the .env.example file and rename it to .env

## Migrations
To create all the nessesary tables and columns, run the following command in Your Command Line Interface

    php artisan migrate

# Author
Tunji Ebifemi
