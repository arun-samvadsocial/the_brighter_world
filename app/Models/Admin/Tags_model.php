<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags_model extends Model
{
    use HasFactory;
    protected $table = 'tag';
    protected $fillable = [
        'tag_name',
        'tag_status',
        'created_at',
        'updated_at'
        ];
}
