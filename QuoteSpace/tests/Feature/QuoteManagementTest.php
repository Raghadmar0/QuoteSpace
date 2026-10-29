<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test Scenario 1: Guest cannot create quotes */
    public function test_guest_cannot_create_quotes()
    {
        $response = $this->post('/quotes', ['content' => 'Sample quote content']);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('quotes', 0);
    }

    /** @test Scenario 2: Guest cannot edit quotes */
    public function test_guest_cannot_edit_quotes()
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $user->id]);

        $response = $this->get("/quotes/{$quote->id}/edit");
        $response->assertRedirect('/login');
    }

    /** @test Scenario 3: Guest cannot delete quotes */
    public function test_guest_cannot_delete_quotes()
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/quotes/{$quote->id}");
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('quotes', 1);
    }

    /** @test Scenario 4: An authenticated user can create a quote */
    public function test_authenticated_user_can_create_quote()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/quotes', [
            'content' => 'A beautifully crafted literary line.',
        ]);

        $response->assertRedirect('/my-quotes');
        $this->assertDatabaseHas('quotes', [
            'user_id' => $user->id,
            'content' => 'A beautifully crafted literary line.',
        ]);
    }

    /** @test Scenario 5: An owner can edit their own quote */
    public function test_owner_can_edit_their_quote()
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $user->id, 'content' => 'Original text']);

        $response = $this->actingAs($user)->put("/quotes/{$quote->id}", [
            'content' => 'Updated text content',
        ]);

        $response->assertRedirect('/my-quotes');
        $this->assertDatabaseHas('quotes', [
            'id' => $quote->id,
            'content' => 'Updated text content',
        ]);
    }

    /** @test Scenario 6: An owner can delete their own quote */
    public function test_owner_can_delete_their_quote()
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/quotes/{$quote->id}");

        $response->assertRedirect('/my-quotes');
        $this->assertDatabaseMissing('quotes', ['id' => $quote->id]);
    }

    /** @test Scenario 7: Another user cannot edit someone else's quote */
    public function test_user_cannot_edit_another_users_quote()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $owner->id, 'content' => 'Owner text']);

        $response = $this->actingAs($otherUser)->put("/quotes/{$quote->id}", [
            'content' => 'Forged edit attempt',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('quotes', ['id' => $quote->id, 'content' => 'Owner text']);
    }

    /** @test Scenario 8: Another user cannot delete someone else's quote */
    public function test_user_cannot_delete_another_users_quote()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $quote = Quote::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($otherUser)->delete("/quotes/{$quote->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('quotes', ['id' => $quote->id]);
    }

    /** @test Scenario 9: Invalid quote lengths are rejected */
    public function test_invalid_quote_lengths_are_rejected()
    {
        $user = User::factory()->create();

        // Too short (< 3 chars)
        $resShort = $this->actingAs($user)->post('/quotes', ['content' => 'Hi']);
        $resShort->assertSessionHasErrors('content');

        // Too long (> 155 chars)
        $longText = str_repeat('a', 156);
        $resLong = $this->actingAs($user)->post('/quotes', ['content' => $longText]);
        $resLong->assertSessionHasErrors('content');

        $this->assertDatabaseCount('quotes', 0);
    }

    /** @test Scenario 10: The quote list is accessible without authentication */
    public function test_quote_list_is_publicly_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Explore Quotes');
    }
}
