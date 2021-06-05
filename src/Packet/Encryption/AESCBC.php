<?php

namespace ImperianSystems\UnifiController\Packet\Encryption;

use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;

class AESCBC
{
    public static function decrypt($payload, $key, $initVector)
    {
        $cipher = new AES('cbc');
        $cipher->setIV($initVector);
        $cipher->setKey($key);
        $cipher->disablePadding();

        try {
            $result = $cipher->decrypt($payload);
        } catch (\Exception $e) {
            throw new \Exception("ImperianSystems\UnifiController\Packet\Encryption\AESCBC:\n".$e->getMessage());
        }

        return $result;
    }

    public static function encrypt()
    {
    }
}
