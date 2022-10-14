<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotesCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_note_route_is_accessible()
    {
        $response = $this->post('/api/note/create');

        $response->assertStatus(200);
    }
}
