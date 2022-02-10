<?php

namespace Tests\Feature;

use App\Models\Candidacy;
use App\Models\Candidate;
use App\Models\Diploma;
use App\Models\Establishment;
use App\Models\Master;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class CandidacyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_we_can_create_candidacy()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        //create a diploma
        $diploma = Diploma::create([
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ]);

        //create an establishment
        $establishment = Establishment::create(['name' => 'First Establishment']);

        //create a master
        $master = Master::create([
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ]);

        //create a speciality
        $speciality = Speciality::create(['name' => 'First Speciality']);

        $formData = [
            'candidacy' => [
                'identity'=>'11121304',
                'firstName'=>'test',
                'lastName'=>'Test',
                'dateOfBirth'=>'04-07-1995',
                'placeOfBirth'=>'Kairouan',
                'nationality'=>'Tunisian',
                'address'=>'Kairouan, Tunisia',
                'country'=>'Tunisia',
                'government'=>'Kairouan',
                'city'=>'Mansourrah',
                'postalCode'=>'3100',
                'phone'=>'22 223 224',
                'email'=>'test@test.com'
            ],
            'study' => [
                "baccalaureateYear"=>2014,
                "baccalaureateAverage"=>15.09,
                "nbOfRepetitionsFromBaccalaureate"=>1,
                "preparatory"=>true,
                "nbOfRepetitionsInPreparatory"=>0,
                "nbOfRegistrationWithdrawals"=>1,
                "yearOfGraduation"=>2020,
                "professionalSituation"=>'Student',
                "numberOfInternships"=>5,
                "speciality_id"=>$speciality->id,
                "diploma_id"=>$diploma->id,
                "establishment_id"=>$establishment->id
            ],
            'higherStudies' => [
                [
                    "schoolYear"=>'2020-2021', 
                    "level"=>1,
                    "continuingStudies"=>'Software Engineering',
                    "mean"=>15,
                    "redouble"=>0,
                    "mention"=>'Good',
                    "session"=>'First',
                    "establishment_id"=>$establishment->id
                ]
            ],
            'choices' => [
                [
                    "choice"=>1,
                    "master_id"=>$master->id
                ]
            ]
        ];

        $this->post('/api/candidacies', $formData)->assertStatus(200);
        $this->assertCount(1, Candidacy::all());
        $this->assertCount(1, Candidate::all());
    }


    public function test_if_we_can_get_candidacy()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        //create a diploma
        $diploma = Diploma::create([
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ]);

        //create an establishment
        $establishment = Establishment::create(['name' => 'First Establishment']);

        //create a master
        $master = Master::create([
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ]);

        //create a speciality
        $speciality = Speciality::create(['name' => 'First Speciality']);

        $formData = [
            'candidacy' => [
                'identity'=>'11121304',
                'firstName'=>'test',
                'lastName'=>'Test',
                'dateOfBirth'=>'04-07-1995',
                'placeOfBirth'=>'Kairouan',
                'nationality'=>'Tunisian',
                'address'=>'Kairouan, Tunisia',
                'country'=>'Tunisia',
                'government'=>'Kairouan',
                'city'=>'Mansourrah',
                'postalCode'=>'3100',
                'phone'=>'22 223 224',
                'email'=>'test@test.com'
            ],
            'study' => [
                "baccalaureateYear"=>2014,
                "baccalaureateAverage"=>15.09,
                "nbOfRepetitionsFromBaccalaureate"=>1,
                "preparatory"=>true,
                "nbOfRepetitionsInPreparatory"=>0,
                "nbOfRegistrationWithdrawals"=>1,
                "yearOfGraduation"=>2020,
                "professionalSituation"=>'Student',
                "numberOfInternships"=>5,
                "speciality_id"=>$speciality->id,
                "diploma_id"=>$diploma->id,
                "establishment_id"=>$establishment->id
            ],
            'higherStudies' => [
                [
                    "schoolYear"=>'2020-2021', 
                    "level"=>1,
                    "continuingStudies"=>'Software Engineering',
                    "mean"=>15,
                    "redouble"=>0,
                    "mention"=>'Good',
                    "session"=>'First',
                    "establishment_id"=>$establishment->id
                ]
            ],
            'choices' => [
                [
                    "choice"=>1,
                    "master_id"=>$master->id
                ]
            ]
        ];
        $this->post('/api/candidacies', $formData)->assertStatus(200);

        $candidacy = Candidacy::all()->last();
        $this->get('/api/candidacies' . $candidacy->id)->assertStatus(200);
    }

    public function test_if_we_can_update_candidacy()
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

        //create a diploma
        $diploma = Diploma::create([
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ]);

        //create an establishment
        $establishment = Establishment::create(['name' => 'First Establishment']);

        //create a master
        $master = Master::create([
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ]);

        //create a speciality
        $speciality = Speciality::create(['name' => 'First Speciality']);

        $formData = [
            'candidacy' => [
                'identity'=>'11121304',
                'firstName'=>'test',
                'lastName'=>'Test',
                'dateOfBirth'=>'04-07-1995',
                'placeOfBirth'=>'Kairouan',
                'nationality'=>'Tunisian',
                'address'=>'Kairouan, Tunisia',
                'country'=>'Tunisia',
                'government'=>'Kairouan',
                'city'=>'Mansourrah',
                'postalCode'=>'3100',
                'phone'=>'22 223 224',
                'email'=>'test@test.com'
            ],
            'study' => [
                "baccalaureateYear"=>2014,
                "baccalaureateAverage"=>15.09,
                "nbOfRepetitionsFromBaccalaureate"=>1,
                "preparatory"=>true,
                "nbOfRepetitionsInPreparatory"=>0,
                "nbOfRegistrationWithdrawals"=>1,
                "yearOfGraduation"=>2020,
                "professionalSituation"=>'Student',
                "numberOfInternships"=>5,
                "speciality_id"=>$speciality->id,
                "diploma_id"=>$diploma->id,
                "establishment_id"=>$establishment->id
            ],
            'higherStudies' => [
                [
                    "schoolYear"=>'2020-2021', 
                    "level"=>1,
                    "continuingStudies"=>'Software Engineering',
                    "mean"=>15,
                    "redouble"=>0,
                    "mention"=>'Good',
                    "session"=>'First',
                    "establishment_id"=>$establishment->id
                ]
            ],
            'choices' => [
                [
                    "choice"=>1,
                    "master_id"=>$master->id
                ]
            ]
        ];
        $this->post('/api/candidacies', $formData)->assertStatus(200);

        $candidacy = Candidacy::all()->last();
        $formData['candidacy']['identity'] = '01020304';
        $formData['study']['id'] = 1;
        $formData['higherStudies'][0]['id'] = 1;
        $formData['choices'][0]['candidacy_id'] = $candidacy->id;
        $this->put('/api/candidacies/' . $candidacy->id, $formData)->assertStatus(200);

        $this->assertCount(1, Candidacy::all());
    }


    public function test_if_we_can_delete_candidacy()
    {
        $user = User::create([
            'firstName' => "Raed",
            'lastName'=> "SBOUI",
            'email' => "raedsboui@gmail.com",
            'username' => "raed",
            'password'=> Hash::make("123"),
        ]);

        $this->actingAs($user);

        //create a diploma
        $diploma = Diploma::create([
            "name" => "First Diploma",
            "years" => 3,
            "years_min" => 4
        ]);

        //create an establishment
        $establishment = Establishment::create(['name' => 'First Establishment']);

        //create a master
        $master = Master::create([
            'title' => "First Master",
            'description'=> "First Master description",
            'createdBy'=>'Me'
        ]);

        //create a speciality
        $speciality = Speciality::create(['name' => 'First Speciality']);

        $formData = [
            'candidacy' => [
                'identity'=>'11121304',
                'firstName'=>'test',
                'lastName'=>'Test',
                'dateOfBirth'=>'04-07-1995',
                'placeOfBirth'=>'Kairouan',
                'nationality'=>'Tunisian',
                'address'=>'Kairouan, Tunisia',
                'country'=>'Tunisia',
                'government'=>'Kairouan',
                'city'=>'Mansourrah',
                'postalCode'=>'3100',
                'phone'=>'22 223 224',
                'email'=>'test@test.com'
            ],
            'study' => [
                "baccalaureateYear"=>2014,
                "baccalaureateAverage"=>15.09,
                "nbOfRepetitionsFromBaccalaureate"=>1,
                "preparatory"=>true,
                "nbOfRepetitionsInPreparatory"=>0,
                "nbOfRegistrationWithdrawals"=>1,
                "yearOfGraduation"=>2020,
                "professionalSituation"=>'Student',
                "numberOfInternships"=>5,
                "speciality_id"=>$speciality->id,
                "diploma_id"=>$diploma->id,
                "establishment_id"=>$establishment->id
            ],
            'higherStudies' => [
                [
                    "schoolYear"=>'2020-2021', 
                    "level"=>1,
                    "continuingStudies"=>'Software Engineering',
                    "mean"=>15,
                    "redouble"=>0,
                    "mention"=>'Good',
                    "session"=>'First',
                    "establishment_id"=>$establishment->id
                ]
            ],
            'choices' => [
                [
                    "choice"=>1,
                    "master_id"=>$master->id
                ]
            ]
        ];

        $this->post('/api/candidacies', $formData)->assertStatus(200);

        $candidacy = Candidacy::all()->last();
        $this->delete('/api/candidacies/' . $candidacy->id)->assertStatus(200);
        $this->assertCount(0, Candidacy::all());
    }


    public function test_if_we_can_delete_multiple_candidacies()
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
            //create a diploma
            $diploma = Diploma::create([
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ]);

            //create an establishment
            $establishment = Establishment::create(['name' => "Establishment $i"]);

            //create a master
            $master = Master::create([
                'title' => "Master $i",
                'description'=> "Master description",
                'createdBy'=>'Me'
            ]);

            //create a speciality
            $speciality = Speciality::create(['name' => "Speciality $i"]);

            $formData = [
                'candidacy' => [
                    'identity'=>"1112130$i",
                    'firstName'=>'test',
                    'lastName'=>'Test',
                    'dateOfBirth'=>'04-07-1995',
                    'placeOfBirth'=>'Kairouan',
                    'nationality'=>'Tunisian',
                    'address'=>'Kairouan, Tunisia',
                    'country'=>'Tunisia',
                    'government'=>'Kairouan',
                    'city'=>'Mansourrah',
                    'postalCode'=>'3100',
                    'phone'=>"22 223 22$i",
                    'email'=>"test$i@test.com"
                ],
                'study' => [
                    "baccalaureateYear"=>2014,
                    "baccalaureateAverage"=>15.09,
                    "nbOfRepetitionsFromBaccalaureate"=>1,
                    "preparatory"=>true,
                    "nbOfRepetitionsInPreparatory"=>0,
                    "nbOfRegistrationWithdrawals"=>1,
                    "yearOfGraduation"=>2020,
                    "professionalSituation"=>'Student',
                    "numberOfInternships"=>5,
                    "speciality_id"=>$speciality->id,
                    "diploma_id"=>$diploma->id,
                    "establishment_id"=>$establishment->id
                ],
                'higherStudies' => [
                    [
                        "schoolYear"=>'2020-2021', 
                        "level"=>1,
                        "continuingStudies"=>'Software Engineering',
                        "mean"=>15,
                        "redouble"=>0,
                        "mention"=>'Good',
                        "session"=>'First',
                        "establishment_id"=>$establishment->id
                    ]
                ],
                'choices' => [
                    [
                        "choice"=>1,
                        "master_id"=>$master->id
                    ]
                ]
            ];
            $this->post('/api/candidacies', $formData)->assertStatus(200);
        }
        $this->assertCount(3, Candidacy::all());
        $this->assertCount(3, Candidate::all());

        $this->delete('/api/candidacies/deleteMultiple/1,2,3')->assertStatus(200);
        $this->assertCount(0, Candidacy::all());
        $this->assertCount(0, Candidate::all());
    }



    public function test_if_we_can_get_all_candidacies()
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
            //create a diploma
            $diploma = Diploma::create([
                "name" => "Diploma $i",
                "years" => 3,
                "years_min" => 4
            ]);

            //create an establishment
            $establishment = Establishment::create(['name' => "Establishment $i"]);

            //create a master
            $master = Master::create([
                'title' => "Master $i",
                'description'=> "Master description",
                'createdBy'=>'Me'
            ]);

            //create a speciality
            $speciality = Speciality::create(['name' => "Speciality $i"]);

            $formData = [
                'candidacy' => [
                    'identity'=>"1112130$i",
                    'firstName'=>'test',
                    'lastName'=>'Test',
                    'dateOfBirth'=>'04-07-1995',
                    'placeOfBirth'=>'Kairouan',
                    'nationality'=>'Tunisian',
                    'address'=>'Kairouan, Tunisia',
                    'country'=>'Tunisia',
                    'government'=>'Kairouan',
                    'city'=>'Mansourrah',
                    'postalCode'=>'3100',
                    'phone'=>"22 223 22$i",
                    'email'=>"test$i@test.com"
                ],
                'study' => [
                    "baccalaureateYear"=>2014,
                    "baccalaureateAverage"=>15.09,
                    "nbOfRepetitionsFromBaccalaureate"=>1,
                    "preparatory"=>true,
                    "nbOfRepetitionsInPreparatory"=>0,
                    "nbOfRegistrationWithdrawals"=>1,
                    "yearOfGraduation"=>2020,
                    "professionalSituation"=>'Student',
                    "numberOfInternships"=>5,
                    "speciality_id"=>$speciality->id,
                    "diploma_id"=>$diploma->id,
                    "establishment_id"=>$establishment->id
                ],
                'higherStudies' => [
                    [
                        "schoolYear"=>'2020-2021', 
                        "level"=>1,
                        "continuingStudies"=>'Software Engineering',
                        "mean"=>15,
                        "redouble"=>0,
                        "mention"=>'Good',
                        "session"=>'First',
                        "establishment_id"=>$establishment->id
                    ]
                ],
                'choices' => [
                    [
                        "choice"=>1,
                        "master_id"=>$master->id
                    ]
                ]
            ];
            $this->post('/api/candidacies', $formData)->assertStatus(200);
        }
        $this->assertCount(3, Candidacy::all());
        $this->assertCount(3, Candidate::all());
        $this->get('/api/candidacies')->assertStatus(200);
    }
}
