<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->boolean('published')->default(true);
            $table->boolean('publish_at_time')->default(false);
            $table->boolean('removed_from_publication')->default(false);
            $table->timestamp('publisher_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('records', function (Blueprint $table) {
            $table->dropColumn('published');
            $table->dropColumn('publish_at_time');
            $table->dropColumn('removed_from_publication');
            $table->dropColumn('publisher_time');
        });
    }
};
