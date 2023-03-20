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
