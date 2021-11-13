<?php

namespace Tests\Feature;
use Auth;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        User::create(['name'=>'test','email'=>'test1@example.com','password'=>bcrypt(32310901)]);
        $testUser = User::query()->first();
       
        $response = $this->actingAs($testUser)->get('/');
        $response->assertStatus(200);
        Auth::logout();
    }
}
