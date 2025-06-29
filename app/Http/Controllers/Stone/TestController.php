<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneApplication;
use App\Models\StoneShowroom;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Test view rendering
     */
    public function index()
    {
        $application = StoneApplication::where('slug', 'via-he')->first();
        
        return view('stone.test', compact('application'));
    }
} 