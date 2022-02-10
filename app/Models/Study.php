<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function candidacy()
    {
        return $this->belongsTo(Candidacy::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function diploma()
    {
        return $this->belongsTo(Diploma::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

}
