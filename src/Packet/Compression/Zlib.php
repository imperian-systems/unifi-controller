<?php

namespace ImperianSystems\UnifiController\Packet\Compression;

use Illuminate\Support\Facades\Log;

class Zlib
{
    public static function compress($payload)
    {
        try {
            $result = zlib_encode($payload);
        } catch (\Exception $e) {
            $message = "Zlib was unable to compress the data.\n".$e->getMessage();
            throw new \Exception($message);
        }
        return $result;
    }

    public static function uncompress($payload)
    {
        $dir = storage_path('zlib');
        if(!is_dir($dir)) mkdir($dir, 0700);

        try {
            $result = zlib_decode($payload);
        } catch (\Exception $e) {
            $inflateContext = inflate_init(ZLIB_ENCODING_DEFLATE);
            $result = inflate_add($inflateContext, $payload, ZLIB_NO_FLUSH);
            $result .= inflate_add($inflateContext, NULL, ZLIB_FINISH);
        }
        return $result;
    }
}
