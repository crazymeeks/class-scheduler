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
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::createRequest()
	 */
	public function it_should_create_class_size($request, $endpoint)
	{
		$response = $this->json('POST', $endpoint . 'save', $request->toArray());

		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Class size has been added');

	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::updateRequest()
	 */
	public function it_should_update_class_size($request, $updateRequest, $endpoint)
	{
		$this->json('POST', $endpoint . 'save', $request->toArray());
		$response = $this->json('PUT', $endpoint . '1/update', $updateRequest->toArray());

		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Class size has been updated');
	}

	/**
	 * @test
	 * @dataProvider Tests\DataProviders\ClassSizeRequestDataProvider::createRequest()
	 */
	public function it_should_delete_class_size($request, $endpoint)
	{
		$this->json('POST', $endpoint . 'save', $request->toArray());
		$response = $this->json('DELETE', $endpoint . '1/delete');
		
		$response->assertStatus(302)
				 ->assertSessionHas('success', 'Class size has been deleted');
	}
	
}