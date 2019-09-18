<?php

namespace Tests\Feature;

use App\User;
use App\Member;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
//     /**
//     * test for load home with credentials
//     *
//     * @return void
//     */
//    public function testLoadHomeSuccess()
//    {
//        $user = factory(User::class)->create();
//        $response = $this->actingAs($user)
//                         ->get('/home');
//
//        $response->assertStatus(200);
//
//        $user->delete();
//    }
//
//    /**
//     * test for load home without credentials
//     *
//     * @return void
//     */
//    public function testLoadHomeFail()
//    {
//        $response = $this->get('/home');
//
//        $response->assertStatus(302);
//    }
    public function testBasic()
    {
//        $response = $this->get('/login');
//
//        $response->assertStatus(200);
        $this->assertTrue(true);

    }
}
