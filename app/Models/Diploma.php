<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'speciality_subject', 'diploma_id');
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }
}


