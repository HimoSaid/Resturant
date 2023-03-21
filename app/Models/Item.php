<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'category_id', 'bounce', 'summary'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function computeBounce()
    {
        if ($this->bounce)
            return $this->bounce;
        if ($this->parent_id)
            return $this->category->computeBounce();
        return null;
    }
    public function scopeFilterCategoryByName($query, $name)
    {
        $query->whereHas('category', function ($query) use ($name) {
            $query->where('name', 'like', $name);
        });
        return $query;
    }
}
