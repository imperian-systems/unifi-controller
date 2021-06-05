<?php

namespace ImperianSystems\UnifiController\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ImperianSystems\UnifiController\InformPacketDecrypter;
use ImperianSystems\UnifiController\Models\UnifiDevice;
use ImperianSystems\UnifiController\Events\Inform;

class InformController extends \App\Http\Controllers\Controller
{
    public function inform(Request $request)
    {
        $body = $request->getContent();

        try {
            $p = new InformPacketDecrypter($body);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return;
        }

        try {
            $json = $p->uncompress();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return;
        }

        try {
            $result = json_decode($json, null, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            Log::error("Failed to decode JSON: ".$e->getMessage());
            return;
        }

        $data = array();
        foreach($result as $k=>$v)
        {   
            $t = gettype($result->$k);
            switch($t)
            {
                case "integer":
                case "boolean":
                case "string":
                    $data[$k] = $v;
                    break;
                case "array":
                case "object":
                    break;
                default:
                    Log::info("Unknown type $t: $k");
                    break;
            }
        }

        $device = UnifiDevice::find($data['serial']);
        if(!$device) $device = UnifiDevice::create($data);
        else $device->fill($data);
        $device->save();
        broadcast(new Inform($device->toArray()));
    }
}
