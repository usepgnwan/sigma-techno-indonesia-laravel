<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articels', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->text('foto')->nullable();
            $table->string('status');
            $table->text('body')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('short_body')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('youtube')->nullable();
            $table->foreignId('categories_id');
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
        Schema::dropIfExists('articels');
    }
}
