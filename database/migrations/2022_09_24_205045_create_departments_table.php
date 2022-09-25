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
    Schema::create('departments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('mall_id')->references("id")->on('malls')->onDelete('cascade');
      $table->string('name', 50);
      $table->string('description');
      $table->string('note');
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
    Schema::dropIfExists('departments');
  }
};
