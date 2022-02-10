<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'master_subject', 'master_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
