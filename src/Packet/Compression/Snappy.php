<?php

namespace ImperianSystems\UnifiController\Packet\Compression;

use Illuminate\Support\Facades\Log;

class Snappy
{
    private static function checkSnappy()
    {
        if(!function_exists("snappy_uncompress"))
        {
            $message = "Device sent packet compressed with snappy compression, but snappy extension is not installed.\n"
                     . "https://github.com/kjdev/php-ext-snappy";
            throw new \Exception($message);
        }
    }

    public static function compress($payload)
    {
        $this->checkSnappy();
        $result = snappy_compress($payload);
        if($result === FALSE)
        {
            $message = "Snappy was unable to compress the data.";
            throw new \Exception($message);
        }
        return $result;
    }

    public static function uncompress($payload)
    {
        $this->checkSnappy();
        $result = snappy_uncompress($payload);
        if($result === FALSE)
        {
            $message = "Packet header indicates snappy compression, but snappy was unable to uncompress the data.";
            throw new \Exception($message);
        }
        return $result;
    }
}
