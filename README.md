# Tomatoes
Simple Rotten Tomatoes API wrapper for Laravel 5

### Setup
Require this package in composer.json and run `composer update`

    "joearcher/tomatoes": "dev-master"

After updating add the ServiceProvider the the providers array in `app/config/app.php`

    'Joearcher\Tomatoes\TomatoesServiceProvider',

And then you can add the facade to the Facades array

    'Tomatoes' =>	'Joearcher\Tomatoes\Facades\Tomatoes',

Publish the config

    artisan vendor:publish

This creates a `tomatoes.php` file in `app/config`

Add your api key to `tomatoes.php`

    'apikey' => '<Your API key here>'




## Usage

Available endpoints:

*	Search - api.rottentomatoes.com/api/public/v1.0/movies.json
*	Movie info - api.rottentomatoes.com/api/public/v1.0/movies/[movie_id].json
*	Movie cast - api.rottentomatoes.com/api/public/v1.0/movies/[movie_id]/cast.json
*	Movie reviews - api.rottentomatoes.com/api/public/v1.0/movies/[movie_id]/reviews.json
*	Similar movies - api.rottentomatoes.com/api/public/v1.0/movies/[movie_id]/similar.json

All requests return an `array()`.



## Search
Search queries can be returned as pages of results, pagination can be performed with the 2nd and 3rd parameters, though they are optional.

Performing a basic search:

```php
Tomatoes::search("Terminator");
```
Will return all results for the given search term.


To search for the term "war" limiting to 10 results per page and viewing page 2 of the results:

```php
Tomatoes::search("war",10,2);
```

**Results are ordered by most recent release date first, this is set by the API and cannot be changed.**




## Movie info
Further information on a specific movie by it's ID:

```php
Tomatoes::movie(771245718);
```
Will return the detailed information for 'Django Unchained'



## Other info
The remaining endpoints take the same format:

```php
Tomatoes::cast(771245718);

Tomatoes::reviews(771245718);

Tomatoes::similar(771245718);
```


## Thanks
Made possible by the awesome [Guzzle Http client](https://github.com/guzzle/guzzle)