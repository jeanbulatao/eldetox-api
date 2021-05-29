<?php

use Carbon\Carbon;

function res($msg = '', $data = null, $code = 200)
{
    return response()->json([
        'code' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}

function getIso($iso_code = null)
{
    if ($iso_code === null) {
        $iso_code = geoip()->getLocation()->iso_code;
    }
    if (strlen($iso_code) > 2) {
        $iso_code = iso2ToIso3($iso_code, true);
    }
    return strtolower(country($iso_code)->getIsoAlpha3());
}

function getMobilePrefix($iso)
{
    if (strlen($iso) > 2) {
        $iso = iso2ToIso3($iso, true);
    }
    return '+' . country($iso)->getCallingCodes()[0];
}

function iso2ToIso3($iso = null, $reverse = false)
{
    if ($iso === null) {
        return null;
    }
    if ($reverse) {
        $data = (new \League\ISO3166\ISO3166)->alpha3($iso);
        return $data['alpha2'];
    } else {
        $data = (new \League\ISO3166\ISO3166)->alpha2($iso);
        return $data['alpha3'];
    }
}


function saveClient()
{
    $user_id = 0;
    if (auth()->id()) {
        $user_id = auth()->id();
    }
    
    $location = geoip()->getLocation(geoip()->getClientIP());
    $location = (array)$location['attributes'];
    $client = new \App\Models\Client;
    $client->user_id = $user_id;
    $client->selected_current_iso = session('iso');
    $client->app_origin = session('origin');
    $client->uuid = session('uuid');
    $client->manufacturer = session('manufacturer');
    $client->version = session('version');
    $client->model = session('model');
    $client->serial = session('serial');
    $client->platform = session('platform');
    $client->location = json_encode($location);
    $client->uri = request()->getRequestUri();
    $client->save();
}