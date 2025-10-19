<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    // Define which fields are mass assignable
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'summary',
        'location',
        'linkedin',
        'education',
        'experience',
        'skills',
        'references',
        'images',
    ];
}
