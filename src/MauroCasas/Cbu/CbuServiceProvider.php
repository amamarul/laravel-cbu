<?php namespace MauroCasas\Cbu {

	use Illuminate\Support\ServiceProvider;

    /**
     * @package Cbu
     * @version 0.1
     * @author Mauro Casas <casas.mauroluciano@gmail.com>
     */

	class CbuServiceProvider extends ServiceProvider {

		/**
		 * Indicates if loading of the provider is deferred.
		 *
		 * @var bool
		 */
		protected $defer = false;

		public function boot(){
			$this->package('maurocasas/laravel-cbu');
		}

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register()
		{
			$this->app['cbu'] = $this->app->share(function($app){
				return new Cbu(
					$app['config']->get('laravel-cbu::config')
					);
			});

			$this->app->bind('MauroCasas\Cbu\Cbu', function($app){
				return $app['cbu'];
			});

			$this->app->booting(function(){
				$loader = \Illuminate\Foundation\AliasLoader::getInstance();
				$loader->alias('Cbu', 'MauroCasas\Cbu\Facades\Cbu');
			});
		}

		/**
		 * Get the services provided by the provider.
		 *
		 * @return array
		 */
		public function provides()
		{
			return array('cbu');
		}

	}

}