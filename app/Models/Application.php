<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_id',
        'resume_path'

    ];
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
