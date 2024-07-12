<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
