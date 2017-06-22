<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',64)->nullable();
            $table->char('mobile',20)->nullable();
            $table->string('name',64)->nullable();
            $table->string('domain',20)->nullable();
            $table->tinyInteger('is_verfiy')->nullable();
            $table->enum('status', ['ok','delete'])->default('ok');
            $table->string('reg_ip',20)->nullable();
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
        Schema::dropIfExists('members');
    }
}
