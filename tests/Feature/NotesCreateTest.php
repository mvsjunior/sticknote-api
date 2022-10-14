<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;

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

    public function test_is_able_to_save_a_new_note()
    {
        $params   = ["note" => "nota-de-teste-74289374098237"];
        $response = $this->post('/api/note/create', $params);

        # Remove a nota de teste
        $nota = Note::where($params)->delete();

        $response->assertStatus(200)
                 ->assertJson([
                    'error' => false
                 ]);

    }
    
}
