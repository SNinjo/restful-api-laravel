<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
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
        $this->assertTrue($this->is_all_users_in_database(json_decode($response->getContent()), [
            ['id'=>1, 'name'=>'jo', 'age'=>20],
            ['id'=>2, 'name'=>'alan', 'age'=>22]
        ]));
    }
    
    // public function test_get_all(): void
    // {
    //     $response = $this->call('GET', '/api/user');
    //     $this->assertEquals(200, $response->getStatusCode());
    //     echo $response->getContent();
    // }
}
