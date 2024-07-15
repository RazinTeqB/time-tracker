<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\{Artisan, DB, Schema};

Artisan::command('inspire', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('telescope:wipe', function () {
    Artisan::call('telescope:clear');
    Artisan::call('telescope:prune');
    Schema::withoutForeignKeyConstraints(function () {
        DB::statement('TRUNCATE TABLE telescope_entries;');
        DB::statement('TRUNCATE TABLE telescope_entries_tags;');
        DB::statement('TRUNCATE TABLE telescope_monitoring;');
    });
})->describe('Call telescope clear and prune command');
