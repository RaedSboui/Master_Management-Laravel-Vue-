<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_user()
    {
        $this->withoutExceptionHandling();
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);
        

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);
        
        $this->post('/api/users', [
            'firstName'=> 'test',
            'lastName'=> 'TEST',
            'email'=>'test@gmail.com',
            'username'=>'test',
            'password'=>'123',
            'role'=>'ADMIN'
        ])->assertStatus(200);
        $this->assertCount(2, User::all());
    }


    public function test_if_we_can_get_user()
    {
        $this->withoutExceptionHandling();
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);
        

        $this->actingAs($user);


        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);
        
        $this->post('/api/users', [
            'firstName'=> 'test',
            'lastName'=> 'TEST',
            'email'=>'test@gmail.com',
            'username'=>'test',
            'password'=>'123',
            'role'=>'ADMIN'
        ])->assertStatus(200);

        $this->assertCount(2, User::all());

        $user = User::all()->last();
        $this->get('/api/users/' . $user->id)->assertStatus(200);
    }

    public function test_if_we_can_update_user()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);

        $this->post('/api/users', [
            'firstName'=> 'test',
            'lastName'=> 'TEST',
            'email'=>'test@gmail.com',
            'username'=>'test',
            'password'=>'123',
            'role'=>'ADMIN'
        ])->assertStatus(200);

        $user = User::all()->last();

        $this->put('/api/users/' . $user->id , [
            'firstName'=> 'test',
            'lastName'=> 'TEST',
            'email'=>'test@gmail.com',
            'username'=>'testUpdate',
            'password'=>'123',
            'role'=>'ADMIN',
            'isLocked'=> false
        ])->assertStatus(200);

        $this->assertCount(2, User::all());
    }


    public function test_if_we_can_delete_user()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);

        $this->post('/api/users', [
            'firstName'=> 'test',
            'lastName'=> 'TEST',
            'email'=>'test@gmail.com',
            'username'=>'test',
            'password'=>'123',
            'role'=>'ADMIN'
        ])->assertStatus(200);

        $user = User::all()->last();

        $this->delete('/api/users/' . $user->id)->assertStatus(200);
        $this->assertCount(1, User::all());
    }


    public function test_if_we_can_delete_multiple_users()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/users', [
                'firstName'=> "test$i",
                'lastName'=> "TEST$i",
                'email'=>"test$i@gmail.com",
                'username'=>"test$i",
                'password'=>"123$i",
                'role'=>'ADMIN'
            ])->assertStatus(200);
        }

        $this->delete('/api/users/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(1, User::all());
    }


    public function test_if_we_can_export_users()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/users', [
                'firstName'=> "test$i",
                'lastName'=> "TEST$i",
                'email'=>"test$i@gmail.com",
                'username'=>"test$i",
                'password'=>"123$i",
                'role'=>'ADMIN'
            ])->assertStatus(200);
        }

        $this->get('/api/users/export/1,2,3')->assertStatus(200);
    }


    public function test_if_we_can_get_all_users()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        DB::table('roles')->insert([
            'name' => 'ADMIN'
        ]);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/users', [
                'firstName'=> "test$i",
                'lastName'=> "TEST$i",
                'email'=>"test$i@gmail.com",
                'username'=>"test$i",
                'password'=>"123$i",
                'role'=>'ADMIN'
            ])->assertStatus(200);
        }  
        $this->get('/api/users')->assertStatus(200);
        $this->assertCount(4, User::all());
    }
}
