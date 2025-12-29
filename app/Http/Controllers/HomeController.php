<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::with('products')->get();

        $productsData = $categories->flatMap(function ($category) {
            return $category->products->map(function ($product) use ($category) {
                return [
                    'key'        => $product->id,
                    'cat'        => mb_strtolower($category->name),
                    'title'      => $product->name,
                    'image'      => $product->photo
                        ? asset('storage/' . $product->photo)
                        : 'https://placehold.co/400x300',
                    'color'      => $product->color_type,
                    'print'      => $product->print_colors_count,
                    'dimensions' => $product->dimensions,
                    'gost'       => (bool) $product->complies_with_gost_fefco,
                    'specs'      => collect($product->specs ?? [])->mapWithKeys(function ($s) {
                        $key = match ((string)$s['type']) {
                            '1'     => 'micro',
                            '2'     => 'threeLayer',
                            '3'     => 'fiveLayer',
                            default => $s['type'],
                        };

                        return [$key => [
                            'profile' => implode(', ', $s['profiles'] ?? []),
                            'grades'  => implode(', ', $s['grades'] ?? []),
                        ]];
                    })->toArray(),
                ];
            });
        })->values();

        $brandingSlides = \App\Models\BrandingImage::where('is_active', true)
            ->pluck('path')
            ->map(fn($path) => asset('storage/' . $path))
            ->toArray();

        return view('home', [
            'categories'   => $categories,
            'productsData' => $productsData,
            'firstTab'     => mb_strtolower($categories->first()->name ?? ''),
            'brandingSlides' => $brandingSlides,
        ]);
    }
}
