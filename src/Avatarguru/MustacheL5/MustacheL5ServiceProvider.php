<?php namespace Avatarguru\MustacheL5;

use Illuminate\Support\ServiceProvider;

class MustacheL5ServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('avatarguru/mustache-l5');

		$app = $this->app;

		$app->extend('view.engine.resolver', function($resolver, $app)
		{
			$resolver->register('mustache', function() use($app)
			{
				return $app->make('Avatarguru\MustacheL5\MustacheEngine');
			});
			return $resolver;
		});

		$app->extend('view', function($env, $app)
		{
			$env->addExtension('mustache', 'mustache');
			return $env;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mustache-l5');
	}

}