<?php

return array(
	
	'group' => array(
		
		'model' => 'Georgebohnisch\Redoubt\Group\EloquentGroup',
		
	),
	
	'user' => array(
		
		'model' => 'Georgebohnisch\Redoubt\User\EloquentUser',
		
	),
	
	'permission' => array(
		
		'model' => 'Georgebohnisch\Redoubt\Permission\Permission',
		
	),

	'user_object_permission' => array(
		
		'model' => 'Georgebohnisch\Redoubt\UserObjectPermission\UserObjectPermission',
		
	),
	
	'group_object_permission' => array(
		
		'model' => 'Georgebohnisch\Redoubt\GroupObjectPermission\GroupObjectPermission',
		
	),
	
);