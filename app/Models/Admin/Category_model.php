<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_model extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_keywords',
        'short_order_status',
        'category_status',
        'created_at',
        'updated_at'
        ];
    
    public function subcategory(){
        return $this->hasMany('App\Models\Admin\Sub_category_model','main_category');
    }
}
