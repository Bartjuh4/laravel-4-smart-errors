<?php

/**
 * Laravel 4 Smart Errors
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   l4-smart-errors
 */

namespace anlutro\L4SmartErrors;

use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class L4SmartErrorsServiceProvider extends ServiceProvider {

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
		$this->app->bindShared('smarterror', function($app) {
			return new ErrorHandler($app);
		});
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		DB::enableQueryLog();

		//$this->package('anlutro/l4-smart-errors', 'smarterror');
		$this->loadViewsFrom(__DIR__ . '/../../views', 'smarterror');
		$this->loadTranslationsFrom(__DIR__ . '/../../lang', 'smarterror');

		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('smarterror.php'),
				], 'config');

		$this->registerAlertLogListener();
	}

	protected function registerAlertLogListener()
	{
		$app = $this->app;
		$callback = function($level, $message, $context) use ($app) {
			if ($level == 'critical' || $level == 'alert' || $level == 'emergency') {
				$app['smarterror']->handleAlert($message, $context);
			}
		};
		$this->app['events']->listen('illuminate.log', $callback);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('smarterror');
	}

}
