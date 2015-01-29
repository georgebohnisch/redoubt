<?php

class BaseTest extends \Illuminate\Foundation\Testing\TestCase
{
	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../../../bootstrap/start.php';
	}
	
	public function setUp()
	{
		parent::setUp();
		
		Schema::dropIfExists('articles');
		Schema::create('articles', function(Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->string('body');
		});
		
		Schema::dropIfExists('users');
		Schema::create('users', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->string('username');
		});
		
		Schema::dropIfExists('groups');
		Schema::create('groups', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('is_admin')->default(false);
		});
		
		Schema::dropIfExists('group_user');
		Schema::create('group_user', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->integer('group_id');
			$table->integer('user_id');
		});
		
		Schema::dropIfExists('permissions');
		Schema::create('permissions', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('object_type');
			$table->string('codename');
		});
		
		Schema::dropIfExists('group_object_permission');
		Schema::create('group_object_permission', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id');
			$table->string('object_type');
			$table->integer('object_id');
			$table->integer('permission_id');
		});
		
		Schema::dropIfExists('user_object_permission');
		Schema::create('user_object_permission', function(\Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('object_type');
			$table->integer('object_id');
			$table->integer('permission_id');
		});
	}
	
	protected function getRedoubt()
	{
		$permission             = new Georgebohnisch\Redoubt\Permission\EloquentProvider('Georgebohnisch\Redoubt\Permission\Permission');
		$userObjectPermission   = new Georgebohnisch\Redoubt\UserObjectPermission\EloquentProvider('Georgebohnisch\Redoubt\UserObjectPermission\UserObjectPermission');
		$groupObjectPermission  = new \Georgebohnisch\Redoubt\GroupObjectPermission\EloquentProvider('Georgebohnisch\Redoubt\GroupObjectPermission\GroupObjectPermission');
		
		return new Georgebohnisch\Redoubt\Redoubt($permission, $userObjectPermission, $groupObjectPermission);
	}
		
	public function testRedoubt()
	{
		$this->assertInstanceOf('Georgebohnisch\Redoubt\Redoubt', $this->getRedoubt());
	}
	
}

class Article extends Illuminate\Database\Eloquent\Model implements \Georgebohnisch\Redoubt\Permission\PermissibleInterface
{
	public $timestamps = false;
	
	public $guarded = [];
	
	public function getPermissions() {
		return array(
			'view' => 'View Article',
			'edit' => 'Edit Article',
		);
	}
}

class Group extends \Georgebohnisch\Redoubt\Group\EloquentGroup
{
	public $timestamps = false;
	public $guarded = [];
}

class User extends \Georgebohnisch\Redoubt\User\EloquentUser
{
	public $timestamps = false;
	public $guarded = [];
}