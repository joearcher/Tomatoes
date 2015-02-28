<?php namespace Joearcher\Tomatoes\Facades;

use Illuminate\Support\Facades\Facade;

class Tomatoes extends Facade{
	protected static function getFacadeAccessor() { return 'tomatoes'; }
}