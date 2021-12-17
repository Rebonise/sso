<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public function getDescriptiveCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('MMMM Do YYYY, HH:mm:ss');
    }

    public function getCreatedAtDifferenceAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    protected $fillable = [
        'user_id',
        'name',
        'key',
    ];
}
