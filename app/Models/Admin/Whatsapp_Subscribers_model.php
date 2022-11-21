<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp_Subscribers_model extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_subscribers';
    protected $fillable = [
        'whatsapp_mobile_no',
        'subscription_date',
        'unsubscribe_date',
        'status',
        'created_at',
        'updated_at'
        ];
}
