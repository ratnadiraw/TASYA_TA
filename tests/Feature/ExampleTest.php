<?php

namespace Tests\Feature;

use Tests\TestCase;
use Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ExampleTest extends TestCase
{

//     /**
//      * A basic test example.
//      *
//      * @return void
//      */

    public function testAdminTA1()
    {
        //login access
        $response = $this->get('/login');
        $response->assertStatus(200);

        //resetpassword access
        $response = $this->get('/password/reset');
        $response->assertStatus(200);

        // login admin success
        $email = 'admin@taifitb.com';
        $password = 'admin';
        Session::start();
        $response = $this->followingRedirects()->call('POST', '/login', [
            'email' => $email,
            'password' => $password,
            '_token' => csrf_token()
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('tu.home', $response->original->name());
    }

    public function testTimTATA1()
    {
        //login access
        $response = $this->get('/login');
        $response->assertStatus(200);

        //resetpassword access
        $response = $this->get('/password/reset');
        $response->assertStatus(200);

        // login admin success
        $email = 'x@x.x';
        $password = '123';
        Session::start();
        $response = $this->followingRedirects()->call('POST', '/login', [
            'email' => $email,
            'password' => $password,
            '_token' => csrf_token()
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('tim_ta.home', $response->original->name());
    }

    public function testAdminTA2()
    {
        //login access
       $response = $this->get('/login');
       $response->assertStatus(200);

       //resetpassword access
       $response = $this->get('/password/reset');
       $response->assertStatus(200);

       // login admin success
       $email = 'admin@taifitb.com';
       $password = 'admin';
        Session::start();
        $response = $this->followingRedirects()->call('POST', '/login', [
            'email' => $email,
            'password' => $password,
            '_token' => csrf_token()
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('tu.home', $response->original->name());

        //login mahasiswa
    }

    public function testDosenTA2()
    {
        //login access
       $response = $this->get('/login');
       $response->assertStatus(200);

       //resetpassword access
       $response = $this->get('/password/reset');
       $response->assertStatus(200);

       // login admin success
       $email = 'f@f.com';
       $password = 'ibufazat';
        Session::start();
        $response = $this->followingRedirects()->call('POST', '/login', [
            'email' => $email,
            'password' => $password,
            '_token' => csrf_token()
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertEquals('dosen.home', $response->original->name());

        //login mahasiswa
    }

}
