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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('delivery_option')->default('shipping')->after('status'); // shipping, pickup
            $table->string('tracking_number')->nullable()->after('delivery_option');
            $table->string('midtrans_snap_token')->nullable()->after('tracking_number');
            $table->text('midtrans_payment_url')->nullable()->after('midtrans_snap_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['delivery_option', 'tracking_number', 'midtrans_snap_token', 'midtrans_payment_url']);
        });
    }
};
