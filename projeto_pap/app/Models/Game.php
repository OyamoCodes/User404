<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'school', 'code', 'created_by', 'configuracao_json', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
