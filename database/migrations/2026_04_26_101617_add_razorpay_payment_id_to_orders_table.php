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
    Schema::table('orders', function (Blueprint $table) {

        if (!Schema::hasColumn('orders', 'razorpay_payment_id')) {
            $table->string('razorpay_payment_id')->nullable();
        }

        if (!Schema::hasColumn('orders', 'payment_method')) {
            $table->string('payment_method')->nullable();
        }

        if (!Schema::hasColumn('orders', 'payment_status')) {
            $table->string('payment_status')->default('Pending');
        }

    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('razorpay_payment_id');
    });
}
};
