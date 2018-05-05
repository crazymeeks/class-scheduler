<?php

namespace Tests\Integration;

use Tests\TestCase;
use Scheduler\App\Models\Semester;
use Scheduler\App\Repositories\SemesterRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Exceptions\DBTransactionException;

class SemesterTest extends TestCase
{

    use WithoutMiddleware;


    /**
     * @test
     * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::createRequest()
     */
    public function it_should_create_semester($request, $endpoint)
    {
        $response = $this->json('POST', $endpoint . 'save', $request->toArray());
        
        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Semester has been added');

        $this->assertDatabaseHas('semesters', $request->all());

    }

    /**
     * @test
     * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::updateRequest()
     */
    public function it_should_update_semester($createRequest, $updateRequest, $endpoint)
    {

        $this->json('POST', $endpoint . 'save', $createRequest->toArray());
        $response = $this->json('PUT', $endpoint . '1/update', $updateRequest->toArray());
        
        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Semester has been updated');

        $this->assertDatabaseHas('semesters', $updateRequest->all());

    }

 /**
     * @test
     * @dataProvider Tests\DataProviders\SemesterRequestDataProvider::createRequest()
     */
    public function it_should_delete_semester($request, $endpoint)
    {
        $this->json('POST', $endpoint . 'save', $request->toArray());
        $response = $this->json('DELETE', $endpoint . '1/delete');

        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Semester has been deleted');
        
    }
}
