# ConcertApp 
Simple Laravel project we can create/delete/edit concert events. 
Also we can add bands for the events , search and sort by date or band name 
# Used Technologies
- Laravel 8
- MySQL
- HTML, JS, CSS
# Installation 
- We need laragon with php version 7^
- After cloning the repo we need to set up the database create a db named:concertDB in laragon 
- .env file
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=concertDB
- DB_USERNAME=root
- DB_PASSWORD=
- after this in the console run "php artisan migrate"
- and "php artisan serve" you should be good to go create an user and start using the app
- Entry point for the website http://localhost:8000/events
