<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_post extends Model
{
    use HasFactory;
    protected $table = 'cat_post';
    protected $fillable = [
        'id',
        'cat_id',
        'post_id'
        ];
}
