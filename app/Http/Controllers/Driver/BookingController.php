<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $services = DriverService::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('is_featured', 'desc')
            ->get();

        return view('driver.booking', compact('services'));
    }
}

