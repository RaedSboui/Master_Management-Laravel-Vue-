<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Establishment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EstablishmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_establishment()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/establishments', ['name' => 'First Establishment'])->assertStatus(200);
        $this->assertCount(1, Establishment::all());
    }

    public function test_if_we_can_update_establishment()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/establishments', ['name' => 'First Establishment'])->assertStatus(200);

        $establishment = Establishment::first();

        $this->put('/api/establishments/' . $establishment->id , ["name" => "First Update Establishment"])->assertStatus(200);

        $this->assertCount(1, Establishment::all());
    }


    public function test_if_we_can_delete_establishment()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/establishments', ['name' => 'First Establishment'])->assertStatus(200);

        $establishment = Establishment::first();

        $this->delete('/api/establishments/' . $establishment->id)->assertStatus(200);
        $this->assertCount(0, Establishment::all());
    }


    public function test_if_we_can_delete_multiple_establishments()
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
            $this->post('/api/establishments', ['name' => "Establishment $i"])->assertStatus(200);
        }

        $this->delete('/api/establishments/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(0, Establishment::all());
    }


    public function test_if_we_can_export_establishments()
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
            $this->post('/api/establishments', ['name' => "Establishment $i"])->assertStatus(200);
        }

        $this->get('/api/establishments/export/1,2,3')->assertStatus(200);
    }


    public function test_if_we_can_get_all_establishments()
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
            $this->post('/api/establishments', ['name' => "Establishment $i"])->assertStatus(200);
        }  

        $this->get('/api/establishments')->assertStatus(200);
        $this->assertCount(3, Establishment::all());
    }

}
