<?php

use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_logs', function (Blueprint $table) {
            $table
                ->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('time_logs', function (Blueprint $table) {
            $table->dropForeignIdFor(Project::class);
            $table->dropColumn('project_id');
        });
    }
};
