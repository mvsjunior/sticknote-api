<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class NotesSelectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_select_all_notes_is_accessible()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        $response = $this->get('/api/notes');

        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200);
    }

    public function test_is_able_to_return_a_list_of_notes()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        $response = $this->get('/api/notes');

        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200)
                 ->assertJson([
                    'error' => false,
                    'notes' => []
                 ]);
    }

    public function test_route_to_select_a_single_note_is_accessible()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        $randomInt = random_int(1,999);
        $response = $this->get('/api/note/' . $randomInt);

        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200);
    }
    
    public function test_is_able_to_return_a_single_note()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        $response = $this->get('/api/note/999');

        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200)
                 ->assertJson([
                    'note' => []
                 ]);
    }
}
