<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy_Buttons_model extends Model
{
    use HasFactory;
    protected $table = 'buy_buttons';
    protected $fillable = [
        'publish_date',
        'buy_button_code',
        'user_id',
        'status',
        'created_at',
        'updated_at'
        ];
}
