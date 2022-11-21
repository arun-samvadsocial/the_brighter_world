<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_role_model extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'role',
        'role_name',
        'role_status',
        'created_at',
        'updated_at'
        ];
}
