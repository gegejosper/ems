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
            $table->bigIncrements('id');
            $table->string('regionalidnumber');
            $table->string('clubidnumber');
            $table->string('personalidnumber');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->string('position');
            $table->string('club');
            $table->string('region');
            $table->string('address');
            $table->string('personalcontact');
            $table->string('bloodtype');
            $table->string('contactperson');
            $table->string('contactpersonnumber');
            $table->string('relation');
            $table->string('idtype');
            $table->string('idnumber');
            $table->string('email');
            $table->string('website');
            $table->string('tin');
            $table->string('bdate');
            $table->string('philhealth');
            $table->string('sssgsis');
            $table->string('pagibig');
            $table->string('religion');
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
