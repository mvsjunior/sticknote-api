<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class NotesDeleteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_route_to_delete_note_is_accessible()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );

        $noteIdTeste = 999;

        if( empty(Note::find($noteIdTeste)) )
        {
            $newNote = new Note();
            $newNote->id = $noteIdTeste;
            $newNote->note = "----";
            $newNote->save();
        }

        $params   = ["id" => $noteIdTeste];

        $response = $this->delete('/api/note/delete', $params);
        
        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);
        
        $response->assertStatus(200);
    }

    public function test_is_able_to_delete_a_note_by_id()
    {
        Sanctum::actingAs(
            User::factory()->create(["token" => "fisdnfoisdoif"]),
            ['*']
        );
        
        $noteIdTeste = 999;

        if( empty(Note::find($noteIdTeste)) )
        {
            $newNote = new Note();
            $newNote->id = $noteIdTeste;
            $newNote->note = "----";
            $newNote->save();
        }

        $params   = ["id" => $noteIdTeste];

        $response = $this->delete('/api/note/delete', $params);

        $userId = auth('sanctum')->user()->id;
        User::destroy($userId);

        $response->assertStatus(200)
                 ->assertJson([
                    'error'    => false
                 ]);
    }
}
