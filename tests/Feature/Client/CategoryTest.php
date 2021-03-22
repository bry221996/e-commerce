<?php

namespace Tests\Feature\Client;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $store;

    protected $storeUri;

    protected $categories;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');

        $user = User::factory()->create();

        $this->store = Store::factory()->create(['owner_id' => $user->id]);

        $this->storeUri = $this->store->baseUri;

        $this->categories = Category::factory()
            ->count(3)
            ->create(['store_id' => $this->store->id]);
    }

    public function test_list_categories()
    {
        $response = $this->get("$this->storeUri/admin/categories");

        $response->assertStatus(200)
            ->assertSee($this->categories->random()->title)
            ->assertSee($this->categories->random()->description);
    }

    public function test_create_categories()
    {
        $data = Category::factory()
            ->make(['store_id' => $this->store->id])
            ->toArray();

        $response = $this->post("$this->storeUri/admin/categories", $data);

        $response->assertRedirect("$this->storeUri/admin/categories");

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_create_sub_category()
    {
        $parentCategory = $this->categories->random();

        $data = Category::factory()
            ->make([
                'store_id' => $this->store->id,
                'parent_id' => $parentCategory->id
            ])
            ->toArray();

        $response = $this->post("$this->storeUri/admin/categories", $data);

        $response->assertRedirect("$this->storeUri/admin/categories");

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_update_category()
    {
        $category = $this->categories->random();

        $data = Category::factory()
            ->make(['store_id' => $this->store->id])
            ->toArray();

        $response = $this->put("$this->storeUri/admin/categories/$category->id", $data);

        $response->assertRedirect("$this->storeUri/admin/categories");

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_delete_category()
    {
        $category = $this->categories->random();

        $response = $this->delete("$this->storeUri/admin/categories/$category->id");

        $response->assertRedirect("$this->storeUri/admin/categories");

        $this->assertNotNull($category->fresh()->deleted_at);
    }
}
