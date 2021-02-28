<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListOwnerStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_owner_can_list_stores()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/my/stores')
            ->assertSuccessful();
    }
}
