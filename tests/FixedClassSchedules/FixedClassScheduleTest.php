<?php

namespace Tests\Semester;

use Tests\TestCase;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Repositories\FixedClassScheduleRepository;

class FixedClassScheduleTest extends TestCase
{

	use WithoutMiddleware;

	/**
	 * @var \Illuminate\Foundation\Application
	 */
	protected $app;

	/**
	 * @var Scheduler\App\Repositories\FixedClassScheduleRepository
	 */
	protected $repo;

	/**
	 * @var Scheduler\App\Models\FixedClassSchedule
	 */
	protected $model;


	public function setUp()
	{
		parent::setUp();

		$this->app = $this->createApplication();

		$this->repo = $this->app->make(FixedClassScheduleRepository::class);

		$this->model = $this->app->make(FixedClassSchedule::class);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::createRequest()
	 */
	public function it_should_create_fixed_class_schedule($request)
	{
		$result = $this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($result);

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::createRequest()
	 */
	public function it_should_delete_fixed_class_schedule($request)
	{
		$this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($this->repo->delete(1));
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::updateRequest()
	 */
	public function it_should_update_fixed_class_schedule($request, $updateRequest)
	{
		$this->repo->saveFromRequest($request, $this->model);

		$model = $this->model->find($updateRequest->id);

		$result = $this->repo->saveFromRequest($updateRequest, $model);

		$this->assertEquals('11:00AM', $model->start_time);

		$this->assertTrue($result);
	}
	
}