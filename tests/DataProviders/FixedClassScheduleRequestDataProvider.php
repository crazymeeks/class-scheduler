<?php


namespace Tests\DataProviders;


use Scheduler\App\Http\Requests\FixedClassScheduleFormRequest;

class FixedClassScheduleRequestDataProvider
{

	/**
	 * @var Scheduler\App\Http\Requests\ClassSizeFormRequest
	 */
	protected $request;

	public function __construct()
	{
		$this->request = new FixedClassScheduleFormRequest;
	}

	public function createRequest()
	{
		$this->request->replace([
			'semester'    => 1,
			'program'     => 1,
			'level'       => 1,
			'block'       => 1,
			'subject'     => 1,
			'day'         => 1,
			'room'        => 1,
			'faculty'     => 1,
			'start_time'  => '8:00AM',
			'end_time'    => '9:30AM',
		]);

		return [
			array($this->request, $this->apiurl())
		];
	}

	public function updateRequest()
	{
		$this->request->replace([
			'semester'    => 1,
			'program'     => 1,
			'level'       => 1,
			'block'       => 1,
			'subject'     => 1,
			'day'         => 1,
			'room'        => 1,
			'faculty'     => 1,
			'start_time'  => '8:00AM',
			'end_time'    => '9:30AM',
		]);
		$request = new FixedClassScheduleFormRequest;

		$request->replace([
			'id' => 1,
			'semester'    => 1,
			'program'     => 1,
			'level'       => 1,
			'block'       => 1,
			'subject'     => 1,
			'day'         => 1,
			'room'        => 1,
			'faculty'     => 1,
			'start_time'  => '11:00AM',
			'end_time'    => '12:00AM',
		]);

		return [
			array($this->request, $request, $this->apiurl())
		];
	}

	private function apiurl()
	{
		return '/admin/fixed-class-schedule/';
	}
}