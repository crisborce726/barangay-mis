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
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->string('postal_id');
            $table->string('phone_number')->nullable();
            $table->string('email_add')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('household_no')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->date('birth_date');
            $table->string('gender');
            $table->string('phone_number')->nullable();
            $table->string('sitio')->nullable();
            
            $table->unsignedBigInteger('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');

            $table->timestamps();
            $table->boolean('status')->default(1)->nullable();;
        });

        Schema::create('barangay_officials', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('image')->nullable();

            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('sector');
            $table->timestamps();
        });

        Schema::create('resident_sectors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');

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
        Schema::dropIfExists('barangays');
        Schema::dropIfExists('residents');
        Schema::dropIfExists('barangay_officials');
        Schema::dropIfExists('sectors');
        Schema::dropIfExists('resident_sectors');
    }
};