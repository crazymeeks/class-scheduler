<?php

namespace Tests\Feature;

use Tests\TestCase;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Repositories\FixedClassScheduleRepository;

class FixedClassScheduleTest extends TestCase
{

	use WithoutMiddleware;
	

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::createRequest()
	 */
	public function it_should_create_fixed_class_schedule($request, $endpoint)
	{
		
		$response = $this->json('POST', $endpoint . 'save', $request->toArray());
		
		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Faculty fixed schedule has been saved.');

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::createRequest()
	 */
	public function it_should_delete_fixed_class_schedule($request, $endpoint)
	{
		$this->json('POST', $endpoint . 'save', $request->toArray());

		$response = $this->json('DELETE', $endpoint . '1/delete');

		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Faculty fixed schedule has been deleted.');
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\FixedClassScheduleRequestDataProvider::updateRequest()
	 */
	public function it_should_update_fixed_class_schedule($request, $updateRequest, $endpoint)
	{

		$this->json('POST', $endpoint . 'save', $request->toArray());

		$response = $this->json('PUT', $endpoint . '1/update', $updateRequest->toArray());
		
		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Faculty fixed schedule has been updated.');
	}
	
}