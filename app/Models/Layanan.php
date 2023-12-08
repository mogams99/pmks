<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function bidangs()
    { 
        return $this->hasOne(Bidang::class, 'id', 'bidangs_id')->select('id', 'nama');
    }
}
