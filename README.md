[TrainerHub](http://trainershub.projektai.nfqakademija.lt/) - Asmeninių trenerių puslapis
===========
[![Build Status](https://travis-ci.org/nfqakademija/trainer-hub.svg?branch=master)](https://travis-ci.org/nfqakademija/trainer-hub)

# Environment requirements

* PHP 7.0
* MySQL
* and the [usual Symfony application requirements](http://symfony.com/doc/current/reference/requirements.html).

# Installation
## Download and prepare the project
1. Clone repository `git clone https://github.com/nfqakademija/trainer-hub.git`
2. cd 'trainer-hub'

## Prepare the project - run commands:
1. Run `composer install`, to install backend dependencies. Provide configuration details for your application.
2. Run `npm install` and `bower install`, to install frontend dependencies.
3. Run `php bin/console doctrine:database:create`, to create MySQL database according to parameters provided in the first step.
4. Run `php bin/console doctrine:schema:update --force`, to create required MySQL tables.
5. Run `php bin/console hautelook:fixtures:load` to insert all needed fixtures to the database.
6. Run `gulp` 

## Run project:
1. Run `php bin/console server:start`, to start the server.
2. Go to `http://127.0.0.1:8000/`.