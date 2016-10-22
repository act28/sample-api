<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LibraryServicesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test cannot create library resource without valid token
     *
     * @return void
     */
    public function test_cannot_create_library_resource_without_valid_token()
    {
        $library = factory(\App\Models\Library\Library::class)->make();
        $this->json('POST', '/api/library', $library->getAttributes(), ['X-VALID-USER' => 'an invalid token']);
        $this->assertResponseStatus(401);
    }

    /**
     * Test can create library resource with valid token
     *
     * @return void
     */
    public function test_can_create_library_resource_with_valid_token()
    {
        $library = factory(\App\Models\Library\Library::class)->make();
        $this->json('POST', '/api/library', $library->getAttributes(), ['X-VALID-USER' => env('API_TOKEN')]);
        $this->assertResponseStatus(201);

        $this->get('/api/library/'.$library->id);
        $actual = json_decode($this->response->getContent(), true);

        $this->assertEquals($library->name, array_get($actual, 'data.name'));
        $this->assertEquals($library->code, array_get($actual, 'data.code'));
        $this->assertEquals($library->abbr, array_get($actual, 'data.abbr'));
        $this->assertEquals($library->url, array_get($actual, 'data.links.1.uri'));
    }
}
