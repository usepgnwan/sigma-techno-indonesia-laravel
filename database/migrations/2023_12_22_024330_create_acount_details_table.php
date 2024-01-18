<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acount_details', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('account_id');
            $table->string('supplier_title')->nullable();
            $table->string('service_title')->nullable();
            $table->string('project_title')->nullable();
            $table->string('team_title')->nullable();
            $table->string('contact_title')->nullable();
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
        Schema::dropIfExists('acount_details');
    }
}
