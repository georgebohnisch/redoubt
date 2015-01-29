<?php namespace Georgebohnisch\Redoubt\Group;

interface GroupInterface
{
	public function getUsers();
	
	public function isAdmin();
}
