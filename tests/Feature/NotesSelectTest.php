<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;

class NotesSelectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_select_all_notes_is_accessible()
    {
        $response = $this->get('/api/notes');

        $response->assertStatus(200);
    }

    public function test_is_able_to_return_a_list_of_notes()
    {
        $response = $this->get('/api/notes');

        $response->assertStatus(200)
                 ->assertJson([
                    'error' => false,
                    'notes' => []
                 ]);
    }
    
}
