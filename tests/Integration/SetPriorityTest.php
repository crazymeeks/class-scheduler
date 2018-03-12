<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SetPriorityTest extends TestCase
{

	use WithoutMiddleware;

    /**
     * @test
     */
   	public function it_can_assign_faculty_to_subject()
   	{
   		$data = $this->getData();

   		$response = $this->json('POST', $this->apiUrl(), $data);

   		$response->assertStatus(200);

   	}

   	private function apiUrl()
   	{
   		return '/admin/set-priority/subject';
   	}

   	private function getData()
   	{
   		$data = [
   			'id' => 1,
   			'faculties'         => [1, 3],
   			'year_created'      => date('Y'),
   			'api'               => true,
   		];
   		return $data;
   	}
}
