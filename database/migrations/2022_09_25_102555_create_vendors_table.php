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
    Schema::create('vendors', function (Blueprint $table) {
      $table->id();
      $table->foreignId('department_id')->references("id")->on('departments')->onDelete('cascade');
      $table->string('name', 50);
      $table->string('phone', 50);
      $table->string('description')->nullable();
      $table->string('note')->nullable();
      $table->string('logo')->nullable();
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
    Schema::dropIfExists('vendors');
  }
};
