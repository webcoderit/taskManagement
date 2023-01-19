<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admission_id');
            $table->string('payment_type');
            $table->unsignedBigInteger('transaction_id');
            $table->string('transaction_number')->nullable();
            $table->string('admission_date');
            $table->string('in_word')->nullable();
            $table->float('total_fee', 8, 2);
            $table->float('advance', 8, 2);
            $table->float('due', 8, 2)->default(0);
            $table->float('today_pay', 8, 2)->nullable();
            $table->float('second_due_payment', 8, 2)->nullable();
            $table->float('third_due_payment', 8, 2)->nullable();
            $table->float('four_due_payment', 8, 2)->nullable();
            $table->float('five_due_payment', 8, 2)->nullable();
            $table->boolean('is_reject')->default(0);
            $table->boolean('is_pay')->default(0);
            $table->boolean('is_paid')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_receipts');
    }
}
