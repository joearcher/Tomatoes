<?php namespace Joearcher\Tomatoes;

/**
* @author Joe Archer <joe.archer@gmail.com>
* @copyright Copyright (c) 2015
* @license    http://www.opensource.org/licenses/mit-license.html MIT License
*/

use Illuminate\Support\ServiceProvider;

class TomatoesServiceProvider extends ServiceProvider {

	public function boot(){
		$this->publishes([
		    __DIR__.'/config/config.php' => config_path('tomatoes.php'),
		]);
	}

	 public function register()
    {
        $this->app['tomatoes'] = $this->app->share(function ($app)
        {
            
            $toms = new Tomatoes();
            
            return $toms;
        });
    }
}