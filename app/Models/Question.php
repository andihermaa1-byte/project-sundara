<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'word_target',
        'sundanese_text',
        'rfid_sequence',
        'difficulty',
    ];

    protected $casts = [
        'rfid_sequence' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}