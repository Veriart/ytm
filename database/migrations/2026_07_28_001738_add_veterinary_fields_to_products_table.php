<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('name');
            $table->string('target_animals')->nullable()->after('description');
            $table->string('dosage_form')->nullable()->after('target_animals');
            $table->string('active_ingredients')->nullable()->after('dosage_form');
            $table->string('registration_number')->nullable()->after('active_ingredients');
            $table->date('expiry_date')->nullable()->after('pharmacist_note');
            $table->string('batch_number')->nullable()->after('expiry_date');
            $table->boolean('needs_prescription')->default(false)->after('batch_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'brand',
                'target_animals',
                'dosage_form',
                'active_ingredients',
                'registration_number',
                'expiry_date',
                'batch_number',
                'needs_prescription',
            ]);
        });
    }
};
