<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Table: tags
 *
 * === Columns ===
 *
 * @property int $id
 * @property string $name
 * @property string|null $color
 * @property Carbon\Carbon|null $created_at
 * @property Carbon\Carbon|null $updated_at
 *
 * === Relationships ===
 * @property-read TimeLog[]|\Illuminate\Database\Eloquent\Collection $users
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(TimeLog::class);
    }
}
