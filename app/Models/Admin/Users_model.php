<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_model extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'oauth_provider',
        'oaut_uid',
        'name',
        'username',
        'email',
        'mobile',
        'password',
        'gender',
        'pass_flag',
        'user_imge',
        'profile_url',
        'about_user',
        'role',
        'token'
        ];
}
