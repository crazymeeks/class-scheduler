<?php

namespace Tests\Integration;

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
        $request = $this->requestData();

        $response = $this->post($this->apiUrl(), $request->toArray());

        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Room has been added');

        $this->assertDatabaseHas('rooms', $request->all());

    }

    /**
     * @test
     */
    public function it_can_update_room()
    {
        $request = $this->requestData();

        $response = $this->json('PUT', $this->apiUrl() . '1', $request->toArray());
        
        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Room has been updated');

        $this->assertDatabaseHas('rooms', $request->all());
    }

    /**
     * @test
     */
    public function it_can_soft_delete_room()
    {

        $request = $this->requestData();
        
        $response = $this->json('DELETE', $this->apiUrl() . '1', $request->toArray());

        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Room has been deleted');

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

    private function apiUrl()
    {
        return '/admin/rooms/';
    }
}
