<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps = false;

    public function candidacy()
    {
        return $this->belongsTo(Candidacy::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}
