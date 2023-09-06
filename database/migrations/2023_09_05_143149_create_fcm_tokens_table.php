<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcmTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcm_tokens', function (Blueprint $table) {
            $table->id();
            $table->longText('token');

            $table->text('browser')->nullable();
            $table->text('browser_version')->nullable();
            $table->text('device')->nullable();
            $table->text('device_type')->nullable();
            $table->text('platform')->nullable();
            $table->text('is_robot')->nullable();
            $table->text('ip')->nullable();

            $table->text('country_name')->nullable();
            $table->text('country_code')->nullable();
            $table->text('region_name')->nullable();
            $table->text('region_code')->nullable();
            $table->text('city_name')->nullable();
            $table->text('zip_code')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

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
        Schema::dropIfExists('fcm_tokens');
    }
}
