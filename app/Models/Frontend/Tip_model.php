<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip_model extends Model
{
    use HasFactory;
    protected $table = 'tip';
    protected $fillable = [
        'tip_id',
        'tip_title',
        'tip_description',
        'img_data',
        'img_data_share',
        'tip_status',
        'guest_flag',
        'user_id',
        'scheduled_status',
        'tw_scheduled_status',
        'job_id',
        'tw_job_id',
        'created_at',
        'updated_at'
        ];
}
