<?php

namespace ImperianSystems\UnifiController;

use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;
use Sop\GCM\AESGCM;
use Illuminate\Support\Facades\Log;

class InformPacketDecrypter {
    public $magic;
    public $packetVersion;
    public $MAC;
    public $flags;
    public $encrypted;
    public $zlib;
    public $snappy;
    public $aesgcm;
    public $initVector;
    public $payloadVersion;
    public $payloadLength;
    public $payload;
    public $compressedPayload;
    public $decryptionFailed;

    public function __construct($packet)
    {
        Log::info("Packet length: ".strlen($packet));
        $this->magic = substr($packet, 0, 4);
        $this->packetVersion = bin2hex(substr($packet, 4, 4));

        for($i = 8; $i < 14; $i++) $this->MAC.= bin2hex($packet[$i]).":";
        $this->MAC = substr($this->MAC, 0, strlen($this->MAC) - 1);

        $flags = intval(bin2hex(substr($packet, 14, 2)), 16);
        $this->flags = $flags;
        $this->encrypted = ($flags & 0x1) ? true : false;
        $this->zlib = ($flags & 0x2) ? true : false;
        $this->snappy = ($flags & 0x4) ? true : false;
        $this->aesgcm = ($flags & 0x8) ? true : false;

        $this->initVector = substr($packet, 16, 16);
        $this->payloadVersion = bin2hex(substr($packet, 32, 4));
        $this->payloadLength = intval(bin2hex(substr($packet, 36, 4)), 16);

        $this->aad = substr($packet, 0, 40);
        $this->payload = substr($packet, 40, strlen($packet) - 56);
        $this->tag = substr($packet, -16);

        $this->dump();
        $this->_decrypt();
    }

    public function _decrypt()
    {
        if($this->aesgcm)
        {
            $this->decryptGCM();
        }
        else
        {
            $this->decryptCBC();
        }
    }

    public function decryptGCM()
    {
        try {
            $this->compressedPayload = AESGCM::decrypt($this->payload, $this->tag, $this->aad, md5("ubnt", true), $this->initVector);
        } catch (\Exception $e) {
            $this->decryptionFailed = $e->getMessage();
            throw new \Exception("GCM.".$e->getMessage());
        }
    }

    public function decryptCBC()
    {
        $cipher = new AES('cbc');
        $cipher->setIV($this->initVector);
        $cipher->setKey(md5("ubnt", true));
        $cipher->disablePadding();

        try {
            $this->compressedPayload = $cipher->decrypt($this->payload);
        } catch (\Exception $e) {
            $this->decryptionFailed = $e->getMessage();
            throw new \Exception("CBC.".$e->getMessage());
        }
    }

    public function uncompress()
    {

        $this->plain = $this->compressedPayload;
        if($this->zlib)
        {
            try {
                $this->plain = zlib_decode($this->compressedPayload);
            } catch (\Exception $e) {
                $this->uncompression_failed = $e->getMessage();
            throw new \Exception("Uncompres.".$e->getMessage());
            }
        }

        if($this->snappy)
        {
	    $this->plain = snappy_uncompress($this->compressedPayload);
        }

        $this->json = json_decode($this->plain);
        return $this->json;
    }

    public function dump()
    {
        $self = clone $this;
        $self->payload = md5($self->payload);
        $self->compressedPayload = md5($self->compressedPayload);
        $self->initVector = md5($self->initVector);
        $self->aad = md5($self->aad);
        $self->tag = md5($self->tag);
        Log::info(print_r($self, 1));
       
    }
}
