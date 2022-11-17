<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['name', 'description'];

    public function categories()
    {
        return $this->hasMany(Category::class)
            ->doesntHave('parent')
            ->orderBy('order_by');
    }
}
