# Tomatoes
Rotten Tomatoes API wrapper for Laravel 5

### Setup
Require this package in composer.json and run `composer update`

    "joearcher/tomatoes": "0.1.x@dev"

After updating add the ServiceProvider the the providers array in app/config/app.php

    'Joearcher\Tomatoes\TomatoesServiceProvider',

And then you can add the facade to the Facades array

    'Tomatoes' =>	'Joearcher\Tomatoes\Facades\Tomatoes',

