<?php

namespace Tests\Integration;

use Tests\TestCase;
use Scheduler\App\Models\Block;
use Scheduler\App\Repositories\BlockRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Scheduler\App\Exceptions\DBTransactionException;

class BlockTest extends TestCase
{

    use WithoutMiddleware;


    /**
     * @test
     * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleCreateRequest()
     */
    public function it_should_create_block($request, $endpoint)
    {
        $response = $this->json('POST', $endpoint . 'save', $request->toArray());
        
        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Block has been added');

        $input = $request->except(['levels']);
        $this->assertDatabaseHas('blocks', $input);

    }

    /**
     * @test
     * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleUpdateRequest()
     */
    public function it_should_update_block($createRequest, $updateRequest, $endpoint)
    {

        $this->json('POST', $endpoint . 'save', $createRequest->toArray());
        $response = $this->json('PUT', $endpoint . '1/update', $updateRequest->toArray());
        
        $input = $updateRequest->except(['levels']);
        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Block has been updated');

        $this->assertDatabaseHas('blocks', $input);

    }

 /**
     * @test
     * @dataProvider Tests\DataProviders\RequestDataProvider::blockModuleCreateRequest()
     */
    public function it_should_delete_block($request, $endpoint)
    {
        $this->json('POST', $endpoint . 'save', $request->toArray());
        $response = $this->json('DELETE', $endpoint . '1/delete');

        $response->assertStatus(302)
                 ->assertSessionHas('success', 'Block has been deleted');
        
    }
}
