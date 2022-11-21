<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos_model extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = [
        'name',
        'video_url',
        'user_id',
        'status',
        'created_at',
        'updated_at'
        ];
}
