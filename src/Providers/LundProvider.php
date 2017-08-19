<?php

namespace G3n1us\Lund\Providers;

/*
if(file_exists(dirname(dirname(__DIR__)).'/vendor/autoload.php'))
	require_once dirname(dirname(__DIR__)).'/vendor/autoload.php';
*/

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
// use Illuminate\Database\Eloquent\Relations\Relation;


// use View;
// use User;
// use Cache;
// use Illuminate\Http\Request;
// use DB;

class LundProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
// 		parent::boot();
	    
/*
	    if ($this->app->runningInConsole()) {
	        $this->commands([
	            Install::class,
	        ]);
	    }	       	    
*/
	    $this->loadRoutesFrom(dirname(__DIR__).'/routes.php');
    
// 	    $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'pub');
        
	    $this->loadMigrationsFrom(dirname(__DIR__).'/database/migrations');        
        
	    $this->publishes([
	        dirname(__DIR__).'/config/pub.php' => config_path('pub.php'),
	    ], 'config');   

    }
    
    

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
	    
	    $this->mergeConfigFrom(dirname(__DIR__).'/config/lund.php', 'lund');        	    
	    
        
		//$loader = \Illuminate\Foundation\AliasLoader::getInstance();
// 	    $loader->alias('Socialite', \Laravel\Socialite\Facades\Socialite::class);		
	    
	    
    }
}
