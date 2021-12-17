<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The project that the client belongs to.
     *
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
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
        'project_id',
        'name',
    ];
}
