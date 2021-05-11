<?php

namespace ImperianSystems\UnifiController\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnifiDevice extends Model
{
    use HasFactory;

    protected $primaryKey = 'serial';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = [ 
        'anon_id', 'architecture', 'board_rev', 'bootid', 'bootrom_version', 
        'cfgversion', 'country_code', 'default', 'discovery_response', 'dualboot',
        'ever_crash', 'fingerprint', 'fw_caps', 'gateway_ip', 'gateway_mac', 'guest_kicks',
        'guest_token', 'has_eth1', 'has_speaker', 'hash_id', 'hostname', 'hw_caps',
        'inform_ip', 'inform_url', 'internet', 'ip', 'isolated', 'kernel_version',
        'last_error', 'locating', 'mac', 'manufacturer_id', 'model', 'model_display',
        'netmask', 'qrid', 'required_version', 'satisfaction', 'satisfaction_now',
        'satisfaction_real', 'selfrun_beacon', 'serial', 'spectrum_scanning', 'state',
        'stream_token', 'sys_error_caps', 'time', 'time_ms', 'tm_ready', 'uplink', 'uptime',
        'version', 'wifi_caps'
    ];
}
