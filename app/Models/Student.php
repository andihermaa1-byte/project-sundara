<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'student_number',
        'name',
        'rfid_uid',
        'mastery_status',
        'weakness_focus',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function learningSessions()
    {
        return $this->hasMany(LearningSession::class);
    }
}