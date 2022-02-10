<?php

namespace Tests\Feature;

use App\Models\Diploma;
use App\Models\Master;
use App\Models\Speciality;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_subject()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        //create a master
        $this->post('/api/masters', [
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ])->assertStatus(200);
        $master = Master::first();

        //create a diploma
        $this->post('/api/diplomas'  , [
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ])->assertStatus(200);
        $diploma = Diploma::first();

        //create a speciality
        $this->post('/api/specialities', ['name' => 'First Speciality'])->assertStatus(200);
        $speciality = Speciality::first();

        $this->post('/api/subjects', ['name' => 'First Subject', 'masters'=>[$master->id], 'diplomas'=>[$diploma->id], 'specialities'=>[$speciality->id]])->assertStatus(200);
        $this->assertCount(1, Subject::all());
    }

    public function test_if_we_can_update_subject()
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
            //create a master
            $this->post('/api/masters', [
                'title' => "Master $i",
                'description'=> "Master $i description",
                'createdBy'=>'Me'
            ])->assertStatus(200);

            //create a diploma
            $this->post('/api/diplomas'  , [
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ])->assertStatus(200);

            //create a speciality
            $this->post('/api/specialities', ['name' => "Speciality $i"])->assertStatus(200);
            $speciality = Speciality::first();
        }

        $this->post('/api/subjects', ['name' => 'First Subject', 'masters'=>[1,2], 'diplomas'=>[1,2], 'specialities'=>[1,2]])->assertStatus(200);

        $subject = Subject::first();

        $this->put('/api/subjects/' . $subject->id , [ "name" => "First Update Subject", 'masters'=>[1,2,3], 'diplomas'=>[1,2,3], 'specialities'=>[1,2,3] ] )->assertStatus(200);

        $this->assertCount(1, Subject::all());
    }


    public function test_if_we_can_delete_subject()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        $this->post('/api/subjects', ['name' => 'First Subject'])->assertStatus(200);

        $subject = Subject::first();

        $this->delete('/api/subjects/' . $subject->id)->assertStatus(200);
        $this->assertCount(0, Subject::all());
    }


    public function test_if_we_can_delete_multiple_subjects()
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
            $this->post('/api/subjects', ['name' => "Subject $i"])->assertStatus(200);
        }

        $this->delete('/api/subjects/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(0, Subject::all());
    }



    public function test_if_we_can_get_all_subjects()
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
            $this->post('/api/subjects', ['name' => "Subject $i"])->assertStatus(200);
        }  

        $this->get('/api/subjects')->assertStatus(200);
        $this->assertCount(3, Subject::all());
    }
}
