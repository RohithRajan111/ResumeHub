<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'description',
        'vacancy'
    ];
    public function application()
    {
        return $this->hasMany(Application::class);
    }
}
