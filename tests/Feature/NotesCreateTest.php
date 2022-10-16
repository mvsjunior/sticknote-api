<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class NotesCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_note_route_is_accessible()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        
        $response = $this->post('/api/note/create');
        
        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);
        
        $response->assertStatus(200);
    }

    public function test_is_able_to_save_a_new_note()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );
        $userId = auth('sanctum')->user()->id;

        $params   = [
            "note"     => "nota-de-teste-74289374098237",
            "user_id"  => $userId
        ];
        
        $response = $this->post('/api/note/create', $params);

        # Remove a nota de teste e o usuário de teste
        $nota   = Note::where($params)->delete();
        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200)
                 ->assertJson([
                    'error' => false
                 ]);

    }
    
}
