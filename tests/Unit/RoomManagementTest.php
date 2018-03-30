<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\Http\Requests\RoomRequest;
use Scheduler\App\Repositories\RoomRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RoomManagementTest extends TestCase
{

	use WithoutMiddleware;


	/**
	 * @test
	 */
	public function it_can_add_room()
	{
		$data = $this->getData();

		$repo = new RoomRepository(new Room());
		
		$request = $this->requestData();

		$repo->saveFormRequest($request);
		exit;
		//$room = Room::create();
		
		$this->assertEquals($data['type'], Room::first()->type);

	}

	private function getData()
	{
		$data = [
			'name' => str_random(),
			'type' => 'Lab',
			'description' => str_random(),
			'status'      => 1,
		];

		return $data;
	}

	private function requestData()
	{
		$request = new Request;

		$request->replace([
			'name' => str_random(),
			'type' => 'Lab',
			'description' => str_random(),
			'status'      => 1,
		]);

		return $request;
	}
}
