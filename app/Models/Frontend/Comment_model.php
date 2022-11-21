<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_model extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'name',
        'email',
        'comment',
        'post_id',
        'approve_flag',
        'created_at',
        'updated_at'
        ];
    
        
        
}
