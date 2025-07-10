<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dialogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'speaker',
        'text',
        'wait_for_input',
        'expected_input',
        'correct_response_text',
        'correct_response_speaker',
        'wrong_response_text',
        'wrong_response_speaker',
        'order',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
