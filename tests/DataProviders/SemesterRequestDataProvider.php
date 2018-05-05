<?php


namespace Tests\DataProviders;


use Scheduler\App\Http\Requests\SemesterFormRequest;

class SemesterRequestDataProvider
{

	/**
	 * @var Scheduler\App\Http\Requests\BlockFormRequest
	 */
	protected $request;

	public function __construct()
	{
		$this->request = new SemesterFormRequest;
	}

	/**
	 * Create request data provider
	 * 
	 * @return array
	 */
	public function createRequest()
	{

		$this->request->replace([
			'semester' => '1'
		]);

		return [
			array($this->request, $this->apiUrl())
		];
	}

	/**
	 * Update module data provider
	 * 
	 * @return
	 */
	public function updateRequest()
	{

		$request = new SemesterFormRequest;
		$request->replace([
			'semester' => '1',
		]);

		$this->request->replace([
			'id'  => 1,
			'semester' => '3',
		]);

		return [
			array($request, $this->request, $this->apiUrl())
		];
	}

	private function apiUrl()
    {
        return '/admin/semesters/';
    }
	
}