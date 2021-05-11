<?php

namespace ImperianSystems\UnifiController\Controllers;

use ImperianSystems\UnifiController\Models\UnifiDevice;
use Illuminate\Http\Request;

class UnifiDeviceController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UnifiDevice::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnifiDevice  $unifiDevice
     * @return \Illuminate\Http\Response
     */
    public function show(UnifiDevice $unifiDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnifiDevice  $unifiDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(UnifiDevice $unifiDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnifiDevice  $unifiDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnifiDevice $unifiDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnifiDevice  $unifiDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnifiDevice $unifiDevice)
    {
        //
    }
}
