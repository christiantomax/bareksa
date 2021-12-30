<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class topicsdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'topicid',
        'newsid'
    ];
}
