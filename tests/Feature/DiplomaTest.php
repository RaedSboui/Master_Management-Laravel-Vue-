<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Diploma;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use File;

class DiplomaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_diploma()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);
        
        $formData = [
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ];

        $this->post('/api/diplomas'  , $formData)->assertStatus(200);
    }

    public function test_if_we_can_update_diploma()
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
        
        $formData = [
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ];

        $this->post('/api/diplomas', $formData)->assertStatus(200);

        $diploma = Diploma::first();
        $this->put('/api/diplomas/' . $diploma->id , [
            "name" => "First Update Diploma",
            "years" => 3,
            "years_min" => 3
        ])->assertStatus(200);
    }


    public function test_if_we_can_delete_diploma()
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
        
        $formData = [
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ];

        $this->post('/api/diplomas', $formData)->assertStatus(200);

        $diploma = Diploma::first();

        $this->delete('/api/diplomas/' . $diploma->id)->assertStatus(200);
    }


    public function test_if_we_can_delete_multiple_diplomas()
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

        for($i=1; $i<=3; $i++){  
            $this->post('/api/diplomas', [
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ])->assertStatus(200);
        }
        $this->delete('/api/diplomas/deleteMultiple/1,2,3')->assertStatus(200);
    }

    public function test_if_we_can_export_diplomas()
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

        for($i=1; $i<=3; $i++){  
            $this->post('/api/diplomas', [
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ])->assertStatus(200);
        }

        $this->get('/api/diplomas/export/1,2,3')->assertStatus(200);
    }

    public function test_if_we_can_get_all_diplomas()
    {
        //$this->withoutExceptionHandling();
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        for($i=1; $i<=3; $i++){  
            $this->post('/api/diplomas', [
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ])->assertStatus(200);
        }  

        $this->get('/api/diplomas')->assertStatus(200);
        $this->assertCount(3, Diploma::all());
    }

}
