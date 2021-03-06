<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The user that the project belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The clients that belong to the project.
     *
     * @return HasMany
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

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
