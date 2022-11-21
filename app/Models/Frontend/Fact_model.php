<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fact_model extends Model
{
    use HasFactory;
    protected $table = 'fact';
    protected $fillable = [
        'fact_id',
        'fact_title',
        'fact_author',
        'fact_publish_date',
        'fact',
        'created_at',
        'updated_at',
        'img_data',
        'img_data_share',
        'fact_status',
        'guest_flag',
        'user_id',
        'is_delete'
        ];
}
