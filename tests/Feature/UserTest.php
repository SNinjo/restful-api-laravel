<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\UserTableSeeder;
use App\Models\User;

class UserTest extends TestCase
{
    private function are_users_same($user1, $user2): bool
    {
        return (
            ($user1->id == $user2->id)
            && ($user1->name == $user2->name)
            && ($user1->age == $user2->age)
        );
    }

    private function is_all_users_in_database($users): bool
    {
        $allUsersInDatabase = User::all();
        if (count($users) != count($allUsersInDatabase)) return false;
        for ($index = 0; $index < count($users); $index++)
        {
            if (!$this->are_users_same($users[$index], $allUsersInDatabase[$index]))
            {
                return false;
            }
        }
        return true;
    }

    public function test_get(): void
    {
        $response = $this->get('/api/user');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(
            $this->is_all_users_in_database(json_decode($response->getContent()))
        );

        // safe
        $this->get('/api/user');
        $this->assertTrue(
            $this->is_all_users_in_database(UserTableSeeder::getObjectStubs())
        );
        $this->get('/api/user');
        $this->assertTrue(
            $this->is_all_users_in_database(UserTableSeeder::getObjectStubs())
        );
    }
    
    public function test_get_all(): void
    {
        $stub = UserTableSeeder::getObjectStubs()[0];
        $response = $this->get("/api/user/{$stub->id}");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(
            $this->are_users_same(json_decode($response->getContent()), $stub)
        );
        
        // safe
        $this->get("/api/user/{$stub->id}");
        $this->assertTrue(
            $this->is_all_users_in_database(UserTableSeeder::getObjectStubs())
        );
        $this->get("/api/user/{$stub->id}");
        $this->assertTrue(
            $this->is_all_users_in_database(UserTableSeeder::getObjectStubs())
        );

        // fake user
        $response = $this->get('/api/user/-1');
        $response
            ->assertStatus(200)
            ->assertExactJson([]);
    }

    public function test_post(): void
    {
        $stub = ['name'=>'john', 'age'=>20];
        $response = $this->post('/api/user', $stub);
        $response
            ->assertStatus(201)
            ->assertJson($stub);
        $stub['id'] = json_decode($response->getContent())->id;
        $this->assertTrue(
            $this->is_all_users_in_database(UserTableSeeder::getObjectStubs($stub))
        );
    }

    public function test_patch(): void
    {
        $stubs = UserTableSeeder::getObjectStubs();
        $stubs[0]->name = 'john';
        $response = $this->patch("/api/user/{$stubs[0]->id}", ['name' => 'john']);
        $response
            ->assertStatus(200)
            ->assertJson((array) $stubs[0]);
        $this->assertTrue($this->is_all_users_in_database($stubs));
    }
    
    public function test_delete(): void
    {
        $stubs = UserTableSeeder::getObjectStubs();
        $deletedId = $stubs[0]->id;
        $response = $this->delete("/api/user/{$deletedId}");
        $response
            ->assertStatus(200)
            ->assertJson((array) $stubs[0]);
        $this->assertTrue($this->is_all_users_in_database([$stubs[1]]));

        // idempotent
        $this->delete("/api/user/{$deletedId}");
        $this->assertTrue($this->is_all_users_in_database([$stubs[1]]));
        $this->delete("/api/user/{$deletedId}");
        $this->assertTrue($this->is_all_users_in_database([$stubs[1]]));
    }
}
