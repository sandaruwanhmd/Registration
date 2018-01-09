<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitiesOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('university_name');
            $table->integer('organization_id')->unsigned();
            $table->integer('is_university_verified')->default(0);
            $table->foreign('university_name')->references('name')->on('universities');
            $table->foreign('organization_id')->references('id')->on('organizations');
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
        Schema::dropIfExists('universities_organizations');
    }
}
