<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote_model extends Model
{
    use HasFactory;
    protected $table = 'quote';
    protected $fillable = [
        'quote_id',
        'quote_author',
        'quote',
        'created_at',
        'updated_at',
        'img_data',
        'img_data_share',
        'quote_status',
        'guest_flag',
        'user_id',
        'scheduled_status',
        'tw_scheduled_status',
        'job_id',
        'tw_job_id',
        'is_delete'
        ];
}
