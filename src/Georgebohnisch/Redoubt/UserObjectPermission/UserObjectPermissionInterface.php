<?php namespace Georgebohnisch\Redoubt\UserObjectPermission;

interface UserObjectPermissionInterface
{
	public function getUser();
		
	public function getObject();
	
	public function getPermission();
}