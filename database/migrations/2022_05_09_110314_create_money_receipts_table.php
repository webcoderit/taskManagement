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
            $table->string('admission_date');
            $table->string('in_word')->nullable();
            $table->float('total_fee', 8, 2);
            $table->float('advance', 8, 2);
            $table->float('due', 8, 2)->default(0);
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
