<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneShowroom;
use Illuminate\Http\Request;

class ShowroomListController extends Controller
{
    /**
     * Display a listing of the showrooms.
     */
    public function index()
    {
        $showrooms = StoneShowroom::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(12);
            
        return view('stone.showrooms.listing', compact('showrooms'));
    }
} 