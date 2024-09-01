<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Menu extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['name', 'parent'];

    public function children()
    {
        return $this->hasMany(Menu::class, "parent", "id");
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, "parent", "id");
    }
}
