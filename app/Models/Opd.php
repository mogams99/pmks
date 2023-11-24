<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'peruntukans_id',
        'nama',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function peruntukans()
    { 
        return $this->hasOne(Peruntukan::class, 'id', 'peruntukans_id')->select('id', 'nama');;
    }
}
