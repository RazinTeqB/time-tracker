<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Table: projects
 *
 * === Columns ===
 *
 * @property int $id
 * @property string $name
 * @property Carbon\Carbon|null $deleted_at
 * @property Carbon\Carbon|null $created_at
 * @property Carbon\Carbon|null $updated_at
 *
 * === Relationships ===
 * @property-read TimeLog[]|\Illuminate\Database\Eloquent\Collection $timeLogs
 */
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    public function timeLogs(): HasMany
    {
        return $this->hasMany(TimeLog::class);
    }
}
