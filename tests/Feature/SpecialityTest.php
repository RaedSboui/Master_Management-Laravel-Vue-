<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Speciality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SpecialityTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_speciality()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/specialities', ['name' => 'First Speciality'])->assertStatus(200);
        $this->assertCount(1, Speciality::all());
    }

    public function test_if_we_can_update_speciality()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/specialities', ['name' => 'First Speciality'])->assertStatus(200);

        $speciality = Speciality::first();

        $this->put('/api/specialities/' . $speciality->id , ["name" => "First Update Speciality"])->assertStatus(200);

        $this->assertCount(1, Speciality::all());
    }


    public function test_if_we_can_delete_speciality()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/specialities', ['name' => 'First Speciality'])->assertStatus(200);

        $speciality = Speciality::first();

        $this->delete('/api/specialities/' . $speciality->id)->assertStatus(200);
        $this->assertCount(0, Speciality::all());
    }


    public function test_if_we_can_delete_multiple_specialities()
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
            $this->post('/api/specialities', ['name' => "Speciality $i"])->assertStatus(200);
        }

        $this->delete('/api/specialities/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(0, Speciality::all());
    }


    public function test_if_we_can_export_specialities()
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
            $this->post('/api/specialities', ['name' => "Speciality $i"])->assertStatus(200);
        }

        $this->get('/api/specialities/export/1,2,3')->assertStatus(200);
    }


    public function test_if_we_can_get_all_specialities()
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
            $this->post('/api/specialities', ['name' => "Speciality $i"])->assertStatus(200);
        }  

        $this->get('/api/specialities')->assertStatus(200);
        $this->assertCount(3, Speciality::all());
    }
}
