<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UnifiDevicesAddAuthkeySiteFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unifi_devices', function (Blueprint $table) {
            $table->string('auth_key')->default('ba86f2bbe107c7c57eb5f2690775c712');
            $table->string('site_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unifi_devices', function (Blueprint $table) {
            $table->dropColumn('auth_key');
            $table->dropColumn('site_id');
        });
    }
}
