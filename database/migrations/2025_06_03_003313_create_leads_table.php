<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('buisness');
            $table->string('website');
            $table->string('service');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('remark');
            $table->enum('status', [
                'new',
                'qualified',
                'not qualified',
                'not responsing',
                'converted',
                ]
            )->default('new');
            $table->enum('source',[
                'straxum social media',
                'zalsoft social media',
            ]);
            $table->integer('created_by');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
