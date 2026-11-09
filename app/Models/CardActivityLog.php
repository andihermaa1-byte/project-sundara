<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['learning_session_id', 'slot_position', 'card_uid', 'is_correct'];

    public function session()
    {
        return $this->belongsTo(LearningSession::class);
    }
}