<?php

namespace Tests\Integration;

use Tests\TestCase;
use Scheduler\App\Models\Block;
use Scheduler\App\Repositories\BlockRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Exceptions\DBTransactionException;

class BlockTest extends TestCase
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

		$this->repo = $this->app->make(BlockRepository::class);

		$this->model = $this->app->make(Block::class);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleCreateRequest()
	 */
	public function it_should_create_block($request)
	{

		$result = $this->repo->saveFromRequest($request, $this->model);

		$this->assertTrue($result);

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleUpdateRequest()
	 */
	public function it_should_update_block($createRequest, $updateRequest)
	{	

		$this->repo->saveFromRequest($createRequest, $this->model);
		$result = $this->repo->saveFromRequest($updateRequest, $this->model->find($updateRequest->id));

		$this->assertTrue($result);
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleCreateRequest()
	 */
	public function it_should_delete_block($request)
	{
		$this->repo->saveFromRequest($request, $this->model);
		$result = $this->repo->delete(1);

		$this->assertTrue($result);
	}
}
