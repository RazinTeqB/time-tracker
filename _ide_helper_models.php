<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models{
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
     * @property-read int|null $time_logs_count
     *
     * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Project onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Project query()
     * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Project withTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Project withoutTrashed()
     */
    class Project extends \Eloquent {}
}

namespace App\Models{
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
     * @property-read int|null $users_count
     *
     * @method static \Database\Factories\TagFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
     * @method static \Illuminate\Database\Eloquent\Builder|Tag whereColor($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
     */
    class Tag extends \Eloquent {}
}

namespace App\Models{
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
     * @property-read int|null $tags_count
     *
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog query()
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereDuration($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereProjectId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereUserId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog withTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|TimeLog withoutTrashed()
     */
    class TimeLog extends \Eloquent {}
}

namespace App\Models{
    /**
     * Table: users
     *
     * === Columns ===
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property Carbon\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon\Carbon|null $created_at
     * @property Carbon\Carbon|null $updated_at
     *
     * === Relationships ===
     * @property-read TimeLog|null $timeLogs
     * @property-read DatabaseNotification|null $notifications
     *
     * === Accessors/Attributes ===
     * @property-read mixed $activeTimeLog
     * @property-read mixed $active_time_log
     * @property-read int|null $notifications_count
     * @property-read int|null $time_logs_count
     *
     * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent {}
}
