<?php

namespace Tests\Integration;

use Tests\TestCase;
use Scheduler\App\Models\Semester;
use Scheduler\App\Repositories\SemesterRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Exceptions\DBTransactionException;

class SemesterTest extends TestCase
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
	 * @var Scheduler\App\Models\Block
	 */
	protected $model;


	public function setUp()
	{
		parent::setUp();

		$this->app = $this->createApplication();

		$this->repo = $this->app->make(SemesterRepository::class);

		$this->model = $this->app->make(Semester::class);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::createRequest()
	 */
	public function it_should_create_semester($request)
	{

		$result = $this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($result);

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::updateRequest()
	 */
	public function it_should_update_semester($createRequest, $updateRequest)
	{	

		$this->repo->saveFromRequest($createRequest, $this->model);
		$result = $this->repo->saveFromRequest($updateRequest, $this->model->find($updateRequest->id));

		$model = $this->model->where('semester', 3)->first();

		$this->assertEquals(3, $model->semester);

		$this->assertTrue($result);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::createRequest()
	 */
	public function it_should_delete_semester($request)
	{
		$this->repo->saveFromRequest($request, $this->model);
		$result = $this->repo->delete(1);

		$this->assertTrue($result);
	}
}
