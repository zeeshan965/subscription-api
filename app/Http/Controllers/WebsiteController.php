<?php

namespace App\Http\Controllers;

use App\Models\Website;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $websites = Website::with('posts')->get();
        return response()->json(['websites' => $websites], 200);
    }
}
