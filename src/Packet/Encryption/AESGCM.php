<?php

namespace ImperianSystems\UnifiController\Packet\Encryption;

class AESGCM
{
    public static function decrypt($payload, $tag, $aad, $key, $initVector)
    {
        try {
            $result = \Sop\GCM\AESGCM::decrypt($payload, $tag, $aad, $key, $initVector);
        } catch (\Exception $e) {
            throw new \Exception("ImperianSystems\UnifiController\Packet\Encryption\AESGCM:\n".$e->getMessage());
        }

        return $result;
    }

    public static function encrypt()
    {
    }
}
