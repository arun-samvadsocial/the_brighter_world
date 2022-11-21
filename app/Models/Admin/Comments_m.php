<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments_m extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'name',
        'email',
        'comment',
        'post_id',
        'created_at',
        'updated_at',
        'approve_flag'
        ];
}
