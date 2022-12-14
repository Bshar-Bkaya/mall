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
    Schema::create('malls', function (Blueprint $table) {
      $table->id();
      $table->foreignId('manager_id')->references("id")->on('managers')->onDelete('cascade');
      $table->string('name', 50);
      $table->string('address')->nullable();
      $table->string('phone', 50);
      $table->integer('space')->default(1000);
      $table->string('note')->nullable();
      $table->string('photo')->nullable();
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
    Schema::dropIfExists('malls');
  }
};
