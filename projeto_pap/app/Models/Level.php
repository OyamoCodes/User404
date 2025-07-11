<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'template_id',
        'theme',
        'input_expected',
        'output_expected',
    ];

    protected $casts = [
        'input_expected' => 'array',
        'output_expected' => 'array',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function dialogues()
    {
        return $this->hasMany(Dialogue::class);
    }
}
