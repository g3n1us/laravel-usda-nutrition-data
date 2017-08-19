<?php

namespace G3n1us\Lund\Providers;

/*
if(file_exists(dirname(dirname(__DIR__)).'/vendor/autoload.php'))
	require_once dirname(dirname(__DIR__)).'/vendor/autoload.php';
*/

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class LundProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
	    
	    $this->loadRoutesFrom(dirname(__DIR__).'/routes.php');
            
	    $this->loadMigrationsFrom(dirname(__DIR__).'/database/migrations');        
        
	    $this->publishes([
	        dirname(__DIR__).'/config/lund.php' => config_path('lund.php'),
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
        
    }
}
