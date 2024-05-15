<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    public function get_category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
