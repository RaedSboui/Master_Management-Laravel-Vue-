<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Master;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MasterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_master()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);
        $this->actingAs($user);

        $this->post('/api/masters', [
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ])->assertStatus(200);
        $this->assertCount(1, Master::all());
    }

    public function test_if_we_can_update_master()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);
        $this->actingAs($user);

        $this->post('/api/masters', [
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ])->assertStatus(200);

        $master = Master::first();

        $this->put('/api/masters/' . $master->id , [
            'title' => "First Update Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ])->assertStatus(200);

        $this->assertCount(1, Master::all());
    }


    public function test_if_we_can_delete_master()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/masters', [
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ])->assertStatus(200);

        $master = Master::first();

        $this->delete('/api/masters/' . $master->id)->assertStatus(200);
        $this->assertCount(0, Master::all());
    }


    public function test_if_we_can_delete_multiple_masters()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/masters', [
                'title' => "Master $i",
                'description'=> "Master $i description",
                'createdBy'=>'Me'
            ])->assertStatus(200);
        }

        $this->delete('/api/masters/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(0, Master::all());
    }


    public function test_if_we_can_export_masters()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/masters', [
                'title' => "Master $i",
                'description'=> "Master $i description",
                'createdBy'=>'Me'
            ])->assertStatus(200);
        }

        $this->get('/api/masters/export/1,2,3')->assertStatus(200);
    }


    public function test_if_we_can_get_all_masters()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/masters', [
                'title' => "Master $i",
                'description'=> "Master $i description",
                'createdBy'=>'Me'
            ])->assertStatus(200);
        }  

        $this->get('/api/masters')->assertStatus(200);
        $this->assertCount(3, Master::all());
    }
}
