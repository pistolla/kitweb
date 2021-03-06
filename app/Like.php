<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id', 'activity_id', 'blog_id', 'comment_id'
    ];
}