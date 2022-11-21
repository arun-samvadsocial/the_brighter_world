<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_category_model extends Model
{
    use HasFactory;
    protected $table = 'sub_category';
    protected $primaryKey = 'main_category';
    protected $fillable = [
        'sub_category_name',
        'sub_category_keywords',
        'sub_category_status',
        'main_category',
        'created_at',
        'updated_at'
        ];
}
