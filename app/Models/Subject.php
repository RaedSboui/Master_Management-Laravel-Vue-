<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function masters()
    {
        return $this->belongsToMany(Master::class, 'master_subject', 'subject_id');
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'speciality_subject', 'subject_id');
    }

    public function diplomas()
    {
        return $this->belongsToMany(Diploma::class, 'diploma_subject', 'subject_id');
    }
}
