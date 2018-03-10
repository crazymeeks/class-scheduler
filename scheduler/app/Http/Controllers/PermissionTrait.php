<?php

namespace Scheduler\App\Http\Controllers;

use Auth;
use Closure;
use Scheduler\App\Models\Role;
use Scheduler\App\Models\Permission;

trait PermissionTrait
{

	/**
	 * Check if user has permission(s)
	 * 
	 * @param  array|string $permissions
	 * 
	 * @return bool
	 */
	public function can($permissions)
	{
		return $this->check($permissions);
	}

	/**
	 * Check if user has a permission(s)
	 *
	 * @param  array|string $permissions
	 * 
	 * @return bool
	 */
	protected function check($permissions)
	{
		$tap = 0;
		$userPermissions = $this->getPermissions();

		$permissions = !is_array($permissions)  ? (array) $permissions : $permissions;

		if (in_array('all', $userPermissions)) {
			return true;
		}

		foreach($permissions as $perm){
			if (in_array($perm, $userPermissions)) {
				$tap++;
			}
		}

		return $tap != 0;
	}

	/**
	 * Get roles of currently authenticated user
	 * 
	 * @return array
	 */
	public function getRoles()
	{
		$roles = $this->authenticatedUser()->roles;

		$_roleIDs = $this->get(function($roles){
			$_roleIDs = [];
			foreach($roles as $role){
				$_roleIDs[] = $role->id;
			}
			return $_roleIDs;
		}, $roles);
		
		$roles = null;
		return $_roleIDs;
	}

	/**
	 * Get permissions of currently authenticated user
	 * based on roles
	 * 
	 * @return array
	 */
	public function getPermissions()
	{
		$roles = $this->getRoles();

		$permissions = $this->get(function($roles){
			$permissions = [];
			foreach($roles as $role){
				$perms = Role::find($role)->permissions;
				foreach($perms as $perm){
					$permissions[] = $perm->permission;
				}
			}
			return $permissions;
		}, $roles);

		return $permissions;
	}


	/**
	 * Get
	 * 
	 * @param  Closure $callback
	 * @param  mixed  $params
	 * 
	 * @return mixed
	 */
	protected function get(Closure $callback, $params)
	{
		return call_user_func($callback, $params);
	}
	

	/**
	 * Get authenticated user
	 * 
	 * @return Scheduler\App\Models\Faculty
	 */
	private function authenticatedUser()
	{
		return Auth::guard('admin')->user();
	}
}