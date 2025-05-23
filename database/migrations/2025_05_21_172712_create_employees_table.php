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
        Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('avatar')->nullable();
        $table->string('username')->nullable();
        $table->string('phone')->nullable();
        $table->string('company')->nullable();
        $table->enum('designation', ['sales', 'developer', 'projectmanager'])->nullable();
        $table->string('website')->nullable();
        $table->string('vat')->nullable();
        $table->text('address')->nullable();
        $table->text('about')->nullable();
        $table->text('date_of_birth')->nullable();
        $table->string('country')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
        $table->string('time_zone')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
