<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HigherStudy extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function candidacy()
    {
        return $this->belongsTo(Candidacy::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
