<?php

namespace ImperianSystems\UnifiController\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnifiSite extends Model
{
    use HasFactory;

    protected $primaryKey = 'serial';
    public $incrementing = false;
    protected $keyType = "string";
}
