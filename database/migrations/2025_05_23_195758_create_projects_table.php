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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('description');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->text('type')->nullable();
            $table->text('start_date');
            $table->text('end_date');
            $table->text('status')->default("pending");
            $table->text('attachments');
            $table->text('members');
            $table->integer('created_by');
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
        Schema::dropIfExists('projects');
    }
};
