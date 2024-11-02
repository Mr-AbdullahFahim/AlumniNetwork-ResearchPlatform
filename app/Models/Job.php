<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobsandintern';

    protected $fillable = ['user_id', 'title', 'company', 'location_type', 'location', 'description', 'type','job_link', 'posted_at'];

    protected $casts = [
        'posted_at' => 'datetime',
    ];
}
