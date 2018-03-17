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

		$response = $this->json('POST', $this->apiUrl(), $data);
		$decodedResponse = json_decode($response->content(), true);
		
		$this->assertEquals(201, $response->status());

		$this->assertArrayHasKey('status', $decodedResponse);
		
	}

	/**
	 * @test
	 */
	public function it_can_update_room()
	{
		$data = $this->getData();

		$response = $this->json('PUT', $this->apiUrl() . '2', $data);

		$decodedResponse = json_decode($response->content(), true);
		
		$this->assertEquals(201, $response->status());
		
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

	private function apiUrl()
	{
		return '/admin/rooms/';
	}
}
