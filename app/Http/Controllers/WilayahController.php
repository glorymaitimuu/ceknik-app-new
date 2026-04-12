<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    /**
     * Get districts for Mimika (94.04)
     */
    public function getDistricts()
    {
        return Cache::remember('wilayah_districts_9404', now()->addDays(30), function () {
            $response = Http::get('https://wilayah.id/api/districts/94.04.json');
            
            if ($response->successful()) {
                return $response->json();
            }

            return ['data' => []];
        });
    }

    /**
     * Get villages for a specific district
     */
    public function getVillages($districtCode)
    {
        // Basic validation for district code format to avoid cache pollution
        if (!preg_match('/^[0-9.]+$/', $districtCode)) {
            return response()->json(['data' => []], 400);
        }

        return Cache::remember("wilayah_villages_{$districtCode}", now()->addDays(30), function () use ($districtCode) {
            $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");
            
            if ($response->successful()) {
                return $response->json();
            }

            return ['data' => []];
        });
    }
}
