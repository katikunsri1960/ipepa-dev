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
        Schema::create('elearning_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 100);
            $table->string('nama_depan', 100);
            $table->string('nama_belakang', 100);
            $table->string('email', 100);
            $table->string('kpm');
            $table->boolean('created')->default(false);
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
        Schema::dropIfExists('elearning_accounts');
    }
};
