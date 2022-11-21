<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_model extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'title',
        'author',
        'synopsis',
        'hashtags',
        'keywords',
        'description',
        'status',
        'publish_date',
        'updation_date',
        'created_at',
        'updated_at',
        'img_path',
        'thumb_img_path',
        'img_source',
        'post_url',
        'sub_category',
        'guest_flag',
        'user_id',
        'category_id',
        'submitted_by',
        'scheduled_status',
        'tw_scheduled_status',
        'job_id',
        'tw_job_id',
        'push_send_flag',
        'push_status',
        'post_type',
        'prev_id',
        'next_id',
        'total_pages',
        'main_post_id',
        'video_link',
        'email_newsletter',
        'newsletter_id ',
        'published_date',
        'post_view_count',
        'is_delete'
        ];

        public function Category(){
            return $this->hasMany('App\Models\Admin\Category_model','category_id');
        }
}
