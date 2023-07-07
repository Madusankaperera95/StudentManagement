<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'marks', 'subject_id', 'student_id')
            ->withPivot('marks')
            ->withTimestamps();
    }
}
