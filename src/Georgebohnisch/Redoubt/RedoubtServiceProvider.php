<?php namespace Georgebohnisch\Redoubt;

/**
 * Service provider for Redoubt
 * 
 * @author Greg Gilbert
 * @link https://github.com/greggilbert
 *
 * @author George Böhnisch
 * @link https://github.com/georgebohnisch
 */

use Illuminate\Support\ServiceProvider;

class RedoubtServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('Georgebohnisch/redoubt');

		$groupModel		 = $this->app['config']->get('redoubt::group.model',		'Georgebohnisch\Redoubt\Group\EloquentGroup');
		$userModel		 = $this->app['config']->get('redoubt::user.model',			'Georgebohnisch\Redoubt\Group\EloquentUser');
		$permissionModel = $this->app['config']->get('redoubt::permission.model',	'Georgebohnisch\Redoubt\Permission\Permission');
		
		$this->app->bind('redoubt.group', $groupModel);
		$this->app->bind('redoubt.user', $userModel);
		$this->app->bind('redoubt.permissionModel', $permissionModel);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerGroupProvider();
		$this->registerPermissionProvider();
		$this->registerGroupObjectPermissionProvider();
		$this->registerUserObjectPermissionProvider();
		
		$this->registerRedoubt();
	}
	
	protected function registerRedoubt()
	{
		$this->app['Redoubt'] = $this->app->share(function($app)
		{	
			return new Redoubt(
				$app['redoubt.permission'],
				$app['redoubt.user_object_permission'],
				$app['redoubt.group_object_permission']
			);
		});
	}

	protected function registerGroupProvider()
	{
		$this->app['redoubt.group.provider'] = $this->app->share(function($app)
		{
			return new Group\EloquentProvider($app['redoubt.group']);
		});
		
	}
	
	protected function registerPermissionProvider()
	{
		$this->app['redoubt.permission'] = $this->app->share(function($app)
		{
			return new Permission\EloquentProvider($app['redoubt.permissionModel']);
		});
		
	}
	
	protected function registerUserObjectPermissionProvider()
	{
		$this->app['redoubt.user_object_permission'] = $this->app->share(function($app)
		{
			$model = $app['config']->get('redoubt::user_object_permission.model', 'Georgebohnisch\Redoubt\UserObjectPermission\UserObjectPermission');
			
			return new UserObjectPermission\EloquentProvider($model);
		});
	}

	
	protected function registerGroupObjectPermissionProvider()
	{
		$this->app['redoubt.group_object_permission'] = $this->app->share(function($app)
		{
			$model = $app['config']->get('redoubt::group_object_permission.model', 'Georgebohnisch\Redoubt\GroupObjectPermission\GroupObjectPermission');
			
			return new GroupObjectPermission\EloquentProvider($model);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}