<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobsandintern';

    protected $fillable = ['title', 'description', 'company', 'location', 'type', 'posted_at'];

    protected $casts = [
        'posted_at' => 'datetime',
    ];
}
