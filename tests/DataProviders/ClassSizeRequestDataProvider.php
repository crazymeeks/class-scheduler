<?php


namespace Tests\DataProviders;


use Scheduler\App\Http\Requests\ClassSizeFormRequest;

class ClassSizeRequestDataProvider
{

	/**
	 * @var Scheduler\App\Http\Requests\ClassSizeFormRequest
	 */
	protected $request;

	public function __construct()
	{
		$this->request = new ClassSizeFormRequest;
	}

	public function createRequest()
	{
		$this->request->replace([
			'program'  => 1,
			'semester' => 1,
			'level'    => 1,
			'block'    => 1,
			'size'     => 30,
		]);

		return [
			array($this->request, $this->apiurl())
		];
	}

	public function updateRequest()
	{
		$this->request->replace([
			'program'  => 1,
			'semester' => 1,
			'level'    => 1,
			'block'    => 1,
			'size'     => 30,
		]);
		$request = new ClassSizeFormRequest;

		$request->replace([
			'id' => 1,
			'program'  => 1,
			'semester' => 1,
			'level'    => 1,
			'block'    => 1,
			'size' => 50,
		]);

		return [
			array($this->request, $request, $this->apiurl())
		];
	}

	private function apiurl()
	{
		return '/admin/class-size/';
	}
}