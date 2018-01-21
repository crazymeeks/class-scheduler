<?php

if (!function_exists('global_plugins')) {

	/**
	 * Get the global plugins of metronic template
	 * @param  string $path
	 * 
	 * @return  string
	 */
	function global_plugins($path = '')
	{
		return asset('assets/global/plugins' . '/' . ltrim($path, '/'));
	}
}

if (!function_exists('global_asset')) {

	/**
	 * Get the global asset of metronic template
	 * 
	 * @param  string $path
	 * 
	 * @return string
	 */
	function global_asset($path = '')
	{
		return asset('assets/global' . '/' . ltrim($path, '/'));
	}
}

if (!function_exists('admin_layout')) {

	/**
	 * Get admin layout of metronic template
	 * 
	 * @param  string $path
	 * 
	 * @return  string
	 */
	function admin_layout($path = '')
	{
		return asset('assets/admin/layout' . '/' . ltrim($path, '/'));
	}
}

if (!function_exists('admin_asset')) {

	/**
	 * Get the admin asset path of metronic template
	 * 
	 * @param  string $path
	 * 
	 * @return string
	 */
	function admin_asset($path = '')
	{
		return asset('assets/admin'. '/' . ltrim($path, '/'));
	}
}

if (!function_exists('global_css')) {

	/**
	 * Get the admin css of metronic template
	 * 
	 * @param  string $path
	 * 
	 * @return string
	 */
	function global_css($path = '')
	{
		return asset('assets/global/css' . '/' . ltrim($path, '/'));
	}
}

if (!function_exists('admin_view')) {

	/**
	 * Get the admin blade template file
	 * 
	 * @param  string $view
	 * @param  array $data        The array of data to pass to the view
	 * 
	 * @return View
	 */
	function admin_view($view, array $data = [])
	{
		return view("scheduler.admin.$view", $data);
	}
}

if (!function_exists('jsvendor')) {

	/**
	 * Get the jsvendor. This vendor is installable using npm
	 * 
	 * @param  string $path
	 * 
	 * @return string
	 */
	function jsvendor($path = '')
	{
		return asset('assets/jsvendor'. '/' . ltrim($path, '/'));
	}
}