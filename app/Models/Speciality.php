<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'speciality_subject', 'speciality_id');
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }
}
