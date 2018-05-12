<?php

namespace Tests\Semester;

use Tests\TestCase;
use Scheduler\App\Models\ClassSize;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Repositories\ClassSizeRepository;

class ClassSizeTest extends TestCase
{

	use WithoutMiddleware;

	/**
	 * @var \Illuminate\Foundation\Application
	 */
	protected $app;

	/**
	 * @var Scheduler\App\Repositories\BlockRepository
	 */
	protected $repo;

	/**
	 * @var Scheduler\App\Models\ClassSize
	 */
	protected $model;


	public function setUp()
	{
		parent::setUp();

		$this->app = $this->createApplication();

		$this->repo = $this->app->make(ClassSizeRepository::class);

		$this->model = $this->app->make(ClassSize::class);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::createRequest()
	 */
	public function it_should_create_class_size($request)
	{
		$result = $this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($result);

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::createRequest()
	 */
	public function it_should_delete_class_size($request)
	{
		$this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($this->repo->delete(1));
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::updateRequest()
	 */
	public function it_should_update_class_size($request, $updateRequest)
	{
		$this->repo->saveFromRequest($request, $this->model);

		$model = $this->model->find($updateRequest->id);

		$result = $this->repo->saveFromRequest($updateRequest, $model);

		$this->assertEquals(50, $model->size);

		$this->assertTrue($result);
	}
	
}