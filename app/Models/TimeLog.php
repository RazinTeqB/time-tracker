<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Table: time_logs
 *
 * === Columns ===
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property Carbon\Carbon|null $started_at
 * @property Carbon\Carbon|null $ended_at
 * @property int|null $duration
 * @property Carbon\Carbon|null $created_at
 * @property Carbon\Carbon|null $updated_at
 * @property Carbon\Carbon|null $deleted_at
 * @property int|null $project_id
 *
 * === Relationships ===
 * @property-read User|null $user
 * @property-read Tag[]|\Illuminate\Database\Eloquent\Collection $tags
 * @property-read Project|null $project
 */
class TimeLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public static function calculateDuration(Carbon|string $startedAt, Carbon|string $endedAt): float
    {
        $s = $startedAt;
        $e = $endedAt;

        if (! ($s instanceof Carbon)) {
            $s = Carbon::parse($s);
        }

        if (! ($e instanceof Carbon)) {
            $e = Carbon::parse($e);
        }

        return $s->diffInSeconds($e);
    }
}
