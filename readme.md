# A simple skeleton of rest api in php

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [How to run?](#run)
* [Status](#status)
* [Contact](#contact)

## General info
I created simple REST API application in clean PHP to improve my skills. 
Tried to make a universal model with CRUD methods. My plan was creating a model which is database schema agnostic.

## Technologies
* PHP 8
* MySQL

## Run
`git clone https://github.com/Krzysztofkasowicz/fitapp-php.git`
`composer install`
`touch .env`
Add credentials to database:
`DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=password`

Run PHP server for example XAMPP. You can quickly send requests using Postman.

## Status
App is still in progress. As first, I will add pagination mechanism.

## Contact
Email address: krzysztofkasowicz1995@gmail.com

