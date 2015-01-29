<?php namespace Georgebohnisch\Redoubt\UserObjectPermission;

/**
 * Interface for defining UserObjectPermissions
 */

interface ProviderInterface
{
	/**
	 * Find a single UserObjectPermission for a given user, object, and permission
	 * @param \Georgebohnisch\Redoubt\User\UserInterface $user
	 * @param mixed $object
	 * @param \Georgebohnisch\Redoubt\Permission\ProviderInterface $permission
	 * @return UserObjectPermission
	 */
	public function findPermission($user, $object, $permission);

	/**
	 * Gets any UserObjectPermissions for a user, an object, or an object's permission
	 * @param \Georgebohnisch\Redoubt\User\UserInterface $user
	 * @param mixed|string|null $object
	 * @param string|null $permission
	 * @return \IteratorAggregate
	 */
	public function findAnyPermission($user = null, $object = null, $permission = null);
	
	/**
	 * Find permissions by user
	 * @param \Georgebohnisch\Redoubt\User\UserInterface $user
	 * @return array(UserObjectPermission)
	 */
	public function findByUser($user);
	
	/**
	 * Find permissions by object
	 * @param Permission $permission
	 * @param mixed $object
	 * @return array(UserObjectPermission)
	 */
	public function findByObject($permission, $object);
	
	/**
	 * Creates a UserObjectPermission
	 * @param array $attributes
	 * @return UserObjectPermission
	 */
	public function create($attributes);
	
	/**
	 * Deletes a UserObjectPermission
	 * @param UserObjectPermission $userObjectPermission
	 */
	public function delete($userObjectPermission);
}

