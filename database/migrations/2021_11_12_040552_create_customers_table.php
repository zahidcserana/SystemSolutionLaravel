<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->decimal('balance', 15, 2)->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('bill_amount')->nullable();
            $table->boolean('active')->default(true);
            $table->date('bill_start_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
