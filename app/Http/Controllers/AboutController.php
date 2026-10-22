<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display the About and System Architecture module.
     */
    public function index(): View
    {
        return view('about');
    }
}
