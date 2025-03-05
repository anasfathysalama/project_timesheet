<?php

namespace App\Models;

use App\Enums\ProjectStatusEnum;
use App\Queries\ProjectQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => ProjectStatusEnum::class
    ];

    public function newEloquentBuilder($query): ProjectQuery
    {
        return new ProjectQuery($query);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_project');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributeValues(): MorphMany
    {
        return $this->morphMany(AttributeValue::class, 'entity');
    }
}
