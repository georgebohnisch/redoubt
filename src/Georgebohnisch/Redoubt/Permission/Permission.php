<?php namespace Georgebohnisch\Redoubt\Permission;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Permission extends Eloquent
{
	protected $table = 'permissions';
	
	public $timestamps = false;
	
	public $guarded = ['id'];
	
}