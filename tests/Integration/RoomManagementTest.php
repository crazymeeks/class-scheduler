<?php

namespace Tests\Integration;

use Tests\TestCase;
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

		$repo = new RoomRepository();
		
		$request = $this->requestData();

		$repo->saveFormRequest($request, new Room());

		$this->assertDatabaseHas('rooms', $request->toArray());
		
	}

	/**
	 * @test
	 */
	public function it_can_update_room()
	{
		// $data = $this->getData();

		// $response = $this->json('PUT', $this->apiUrl() . '2', $data);

		// $decodedResponse = json_decode($response->content(), true);
		
		// $this->assertEquals(201, $response->status());


		$repo = new RoomRepository();
		
		$request = $this->updatedData();

		$repo->saveFormRequest($request, Room::find(1));

		$this->assertDatabaseHas('rooms', $request->toArray());
	}

	/**
	 * @test
	 */
	public function it_can_soft_delete_room()
	{
		$repo = new RoomRepository();

		$response = $repo->delete(Room::find(1));


		$room = Room::onlyTrashed()->get();
		
		$this->assertTrue($response);

		$this->assertCount(1, $room);

	}

	private function getData()
	{
		$data = [
			'name'        => str_random(),
			'type'        => 'Lab',
			'description' => str_random(),
			'status'      => 1,
			'api'         => true,
		];

		return $data;
	}

	private function requestData()
	{
		$request = new RoomRequest;

		$request->replace([
			'name' => str_random(),
			'type' => 'Lab',
			'description' => str_random(),
			'status'      => 1,
		]);

		return $request;
	}

	private function updatedData()
	{
		$request = new RoomRequest;

		$request->replace([
			'name' => str_random(),
			'type' => 'Lab',
			'description' => str_random(),
			'status'      => 1,
		]);

		return $request;
	}

	private function apiUrl()
	{
		return '/admin/rooms/';
	}
}
