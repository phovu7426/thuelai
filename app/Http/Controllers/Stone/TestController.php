<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneShowroom;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Test view rendering
     */
    public function index()
    {
        $showrooms = StoneShowroom::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(12);
            
        return view('stone.test', compact('showrooms'));
    }
} 