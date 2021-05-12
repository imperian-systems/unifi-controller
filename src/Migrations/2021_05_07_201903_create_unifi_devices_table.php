<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnifiDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unifi_devices', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->string('anon_id');
            $table->string('architecture');
            $table->bigInteger('board_rev');
            $table->bigInteger('bootid');
            $table->string('bootrom_version');
            $table->string('cfgversion');
            $table->bigInteger('country_code')->nullable();
            $table->boolean('default');
            $table->boolean('discovery_response');
            $table->boolean('dualboot');
            $table->boolean('ever_crash');
            $table->string('fingerprint');
            $table->bigInteger('fw_caps');
            $table->string('gateway_ip');
            $table->string('gateway_mac');
            $table->bigInteger('guest_kicks');
            $table->string('guest_token');
            $table->boolean('has_eth1');
            $table->boolean('has_speaker');
            $table->string('hash_id');
            $table->string('hostname');
            $table->bigInteger('hw_caps');
            $table->string('inform_ip')->nullable();
            $table->string('inform_url');
            $table->boolean('internet');
            $table->string('ip');
            $table->boolean('isolated');
            $table->string('kernel_version');
            $table->string('last_error');
            $table->boolean('locating');
            $table->string('mac');
            $table->bigInteger('manufacturer_id');
            $table->string('model');
            $table->string('model_display');
            $table->string('netmask');
            $table->string('qrid');
            $table->string('required_version');
            $table->bigInteger('satisfaction')->nullable();
            $table->bigInteger('satisfaction_now')->nullable();
            $table->bigInteger('satisfaction_real')->nullable();
            $table->boolean('selfrun_beacon');
            $table->string('serial');
            $table->primary('serial');
            $table->boolean('spectrum_scanning')->nullable();
            $table->bigInteger('state');
            $table->string('stream_token');
            $table->bigInteger('sys_error_caps');
            $table->bigInteger('time');
            $table->bigInteger('time_ms');
            $table->boolean('tm_ready');
            $table->string('uplink');
            $table->bigInteger('uptime');
            $table->string('version');
            $table->bigInteger('wifi_caps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unifi_devices');
    }
}
