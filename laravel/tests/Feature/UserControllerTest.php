<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp() :void
    {
        parent::setUp();
//$this->user = factory(User::class)->create();
    }

    public function testshowProfile()
    {
        $user_data = factory(User::class, 5)->create();
        $user = $user_data->first();
        $this->actingAs($user);
        $response = $this->get(route('users.show_profile', ['user' => $user->id]))
                            ->assertOk()
                            ->assertSee($user->name);
    }

}
