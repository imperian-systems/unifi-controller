<?php

namespace ImperianSystems\UnifiController\Seeders;

use Illuminate\Database\Seeder;
use ImperianSystems\UnifiController\Models\UnifiSite;

class UnifiSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new UnifiSite();
        $site->id = "default";
        $site->name = "Default site";
        $site->save();
    }
}
