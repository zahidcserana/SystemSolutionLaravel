<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->string('type')->nullable();
            $table->date('for_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('paid', 15, 2)->default(0);
            $table->string('status')->nullable();

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
