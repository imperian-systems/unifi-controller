<?php

namespace ImperianSystems\UnifiController;

use Illuminate\Support\Facades\Log;
use ImperianSystems\UnifiController\Packet\Encryption\AESGCM;
use ImperianSystems\UnifiController\Packet\Encryption\AESCBC;
use ImperianSystems\UnifiController\Packet\Compression\Snappy;
use ImperianSystems\UnifiController\Packet\Compression\Zlib;

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
        if($this->aesgcm) $this->payload = substr($packet, 40, strlen($packet) - 56);
        else $this->payload = substr($packet, 40, strlen($packet) - 40);
        $this->tag = substr($packet, -16);

        $this->dump();
        $this->decrypt();
    }

    public function decrypt()
    {
        if(!$this->encrypted)
        {
            Log::info("Note: Packet was not marked encrypted.");
            $this->compressedPayload = $this->payload;
            return;
        }

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
        $this->compressedPayload = AESGCM::decrypt($this->payload, $this->tag, $this->aad, md5("ubnt", true), $this->initVector);
    }

    public function decryptCBC()
    {
        $this->compressedPayload = AESCBC::decrypt($this->payload, md5("ubnt", true), $this->initVector);
    }

    public function uncompress()
    {
        if($this->zlib)
        {
            $this->plain = Zlib::uncompress($this->compressedPayload);
            return $this->plain;
        }

        if($this->snappy)
        {
            $this->plain = Snappy::uncompress($this->compressedPayload);
            return $this->plain;
        }

        throw new \Exception("Unimplemented compression algorithm.");
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
