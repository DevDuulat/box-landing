<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ru', 'kg'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back()->withInput() ?? redirect('/');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/order', [LeadController::class, 'store'])->name('order.store');
