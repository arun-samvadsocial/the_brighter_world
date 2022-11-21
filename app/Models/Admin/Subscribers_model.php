<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers_model extends Model
{
    use HasFactory;
    protected $table = 'email_subscribers';
    protected $fillable = [
        'subscriber_email',
        'subscription_date',
        'unsubscribe_date',
        'status',
        'created_at',
        'updated_at'
        ];
}
