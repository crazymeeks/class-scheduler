<?php

namespace Tests\Unit;

use Tests\TestCase;
use Scheduler\App\Models\Room;
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

		$room = Room::create($data);
		
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
}
