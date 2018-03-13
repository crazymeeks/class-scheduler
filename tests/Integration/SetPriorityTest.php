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

    /**
     * @test
     */
    public function it_can_assign_subject_to_faculty()
    {
      $data = [
        'id' => 1,
        'subjects' => [1],
        'year_created' => date('Y'),
        'api'          => true,
      ];

      $response = $this->json('POST', '/admin/set-priority/', $data);

      $response->assertStatus(200);
      
    }

   	private function apiUrl()
   	{
   		return '/admin/set-priority';
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
