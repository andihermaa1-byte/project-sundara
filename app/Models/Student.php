<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['class_room_id', 'student_number', 'name'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}