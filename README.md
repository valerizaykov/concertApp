# ConcertApp 
Simple Laravel project we can create/delete/edit concert events. 
Also we can add bands for the events , search and sort by date or band name 
# Used Technologies
- Laravel 8
- MySQL
- HTML, JS, CSS,JQuery
# Installation 
- We need Laragon with php version 7^
- After cloning the repo we need to set up the database create a db named:concertDB in Laragon 
- copy the .env.example file and rename it to .env file change the DB_DATABASE property to "concertDB" 
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=concertDB
- DB_USERNAME=root
- DB_PASSWORD=
- in the console run "composer install"
- also "php artisan key:generate"
- after this run "php artisan migrate" to set the database
- and "php artisan serve" you should be good to go create an user and start using the app
- Entry point for the website http://localhost:8000/events
