<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidacy extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function higherStudies()
    {
        return $this->hasMany(HigherStudy::class);
    }

    public function study()
    {
        return $this->hasOne(Study::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }
}
