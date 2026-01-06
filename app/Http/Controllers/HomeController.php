<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function index(HomeService $homeService)
    {
        return view('home', $homeService->getHomeData());
    }
}
