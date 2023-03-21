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
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
    public function computeBounce()
    {
        if ($this->bounce)
            return $this->bounce;
        if ($this->parent_id)
            return $this->parent->computeBounce();
        return null;
    }
    public function scopeMainCategory($query)
    {
        $query->whereNull('parent_id');
    }
    public function scopeParentName($query, $name)
    {
        if ($name)
            $query->whereHas('parent', function ($query) use ($name) {
                $query->where('name', 'like', $name);
            });

        return  $query;
    }
    public function countLevel()
    {
        if ($this->parent_id == 0) {
            return 0;
        }
        return 1 + $this->parent->countLevel();
    }
    //Checks if the class is within the parents so that we don't get a loop
    public function notInTheParentaSeries($valueId)
    {
        //check if category 
        if ($this->id == $valueId) {
            return false;
        }
        if ($this->parent_id)
            return true && $this->parent->notInTheParentaSeries($valueId);

        return true;
    }
}
