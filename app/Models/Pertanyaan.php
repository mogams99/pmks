<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertanyaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function tipe_jawabans()
    {
        return $this->belongsTo(TipeJawaban::class, 'tipe_jawabans_id', 'id')->select('id', 'nama')->where('status', true);
    }

    public function layanans()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id', 'id')->select('id', 'bidangs_id',  'nama')->where('status', true);
    }
}
