<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(); // assumes 'customers' table exists
            $table->foreignId('createdby')->constrained('users'); // fix here
            $table->longText('product')->nullable();
            $table->longText('qty')->nullable();
            $table->longText('price')->nullable();
            $table->longText('total')->nullable();
            $table->longText('invoice_description')->nullable();
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->decimal('tax_percent', 5, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->date('issue_date');
            $table->string('invoice_stripe_id')->nullable();
            $table->string('invoice_payment_link')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
