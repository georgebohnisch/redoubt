<?php namespace Georgebohnisch\Redoubt\User;

/**
 * Interface for defining Users
 */

interface UserInterface
{
	/**
	 * Returns a collection of Groups
	 * @return \IteratorAggregate
	 */
	public function getGroups();
	
	/**
	 * Determines whether or not a user is in a list of groups
	 * @param array(\Georgebohnisch\Redoubt\Group\GroupInterface) $groups
	 * @return boolean
	 */
	public function inGroup($groups);
}
