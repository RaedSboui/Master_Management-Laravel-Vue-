<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function higherStudies()
    {
        return $this->hasMany(HigherStudy::class);
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }
}
