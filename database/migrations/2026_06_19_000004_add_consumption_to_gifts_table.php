<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gifts', function (Blueprint $table) {
            $table->timestamp('consumed_at')->nullable()->after('return_url');
            $table->foreignId('consumed_by')->nullable()->after('consumed_at')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('gifts', function (Blueprint $table) {
            $table->dropForeign(['consumed_by']);
            $table->dropColumn(['consumed_at', 'consumed_by']);
        });
    }
};
