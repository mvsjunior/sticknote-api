<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;

class NotesUpdateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_to_update_note_is_accessible()
    {
        $response = $this->put('/api/note/update');

        $response->assertStatus(200);
    }

    public function test_is_able_to_update_a_note_by_id()
    {

        $params   = ["id" => 1, 'done' => 0];

        $response = $this->put('/api/note/update', $params);

        $response->assertStatus(200)
                 ->assertJson([
                    'error'    => false
                 ]);
    }

}
