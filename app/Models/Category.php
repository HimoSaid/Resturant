<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parent_id', 'name', 'summary', 'bounce'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function subCategorires()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
