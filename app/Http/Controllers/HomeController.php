<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::with('products')->get();

        $tabNames = $categories->pluck('name')->map(fn($n) => mb_strtolower($n))->toArray();

        return view('home', compact('categories', 'tabNames'));
    }
}
