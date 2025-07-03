<?php

namespace App\Http\Controllers;

use App\Models\StoneShowroom;
use Illuminate\Http\Request;

class TestShowroomController extends Controller
{
    public function index()
    {
        $showrooms = StoneShowroom::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(12);
            
        return view('test_showroom', compact('showrooms'));
    }
} 