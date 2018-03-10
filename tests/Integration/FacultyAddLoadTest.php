<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FacultyAddLoadTest extends TestCase
{

	use WithoutMiddleware;

    /**
     * @test
     */
   	public function it_can_add_load_to_faculty()
   	{
   		
   		$data = $this->getData();

   		$response = $this->json('POST', $this->apiUrl(), $data);

   		$response->assertStatus(200);

   	}

   	private function apiUrl()
   	{
   		return '/admin/faculty/update-load';
   	}

   	private function getData()
   	{
   		$data = [
   			'id' => 1,
   			'subject'           => 2,
   			'year_created'      => date('Y'),
   			'api'               => true,
   		];
   		return $data;
   	}
}
