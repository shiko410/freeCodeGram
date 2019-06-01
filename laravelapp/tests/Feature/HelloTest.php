<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
#page329 一般的な値のテスト
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
#page331 指定アドレスにアクセスする。
use App\User; 
#page334 データベースをテストする。
use App\Person;

class HelloTest extends TestCase
{
 use DatabaseMigrations;

   public function testHello()
   {
       // ダミーで利用するデータ
       factory(User::class)->create([
           'name' => 'AAA',
           'email' => 'BBB@CCC.COM',
           'password' => 'ABCABC',
       ]);
       factory(User::class, 10)->create();

       $this->assertDatabaseHas('users', [
           'name' => 'AAA',
           'email' => 'BBB@CCC.COM',
           'password' => 'ABCABC',
       ]);

       // ダミーで利用するデータ
       factory(Person::class)->create([
           'name' => 'XXX',
           'mail' => 'YYY@ZZZ.COM',
           'age' => 123,
       ]);
       factory(Person::class, 10)->create();

       $this->assertDatabaseHas('people', [
           'name' => 'XXX',
           'mail' => 'YYY@ZZZ.COM',
           'age' => 123,
       ]);
   }
}
/*
class HelloTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testHello()
    {
        $this->assertTrue(true);
        
        $response = $this->get('/');
        $response->assertStatus(200);
        
        $response = $this->get('/hello');
        $response->assertStatus(302);
        
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/hello');
        $response->assertStatus(200);
        
        $response = $this->get('/no_route');
        $response->assertStatus(404);
        
        #page329        
        // $arr = [];
        // $this->assertEmpty($arr);
        
        // $msg = "Hello";
        // $this->assertEquals('Hello', $msg);
        
        // $n = random_int(0, 100);
        // $this->assertLessThan(100, $n);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * #/
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
*/