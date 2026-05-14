<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('error_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('branch');
            $table->integer('application_id')->nullable();
            $table->string('issuse');
            $table->string('impact')->nullable();
            $table->text('root_cause')->nullable();
            $table->time('estimated_down')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('issue_triggered_by')->nullable();
            $table->string('error_message')->nullable();
            $table->string('severity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_trackers');
    }
};
