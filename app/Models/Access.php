<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    public function menu()
    { 
        return $this->hasOne(Menu::class, 'id', 'menus_id')->where('status', true)->orderBy('order', 'asc');
    }
}
