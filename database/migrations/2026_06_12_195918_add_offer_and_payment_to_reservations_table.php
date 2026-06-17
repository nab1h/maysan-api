<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('offer_id')->nullable()->after('doctor_id')->constrained()->nullOnDelete();

            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'failed'])->default('unpaid')->after('status');

            $table->enum('payment_method', ['cash', 'online'])->default('cash')->after('payment_status');

            $table->string('transaction_id')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropColumn(['offer_id', 'payment_status', 'payment_method', 'transaction_id']);
        });
    }
};
