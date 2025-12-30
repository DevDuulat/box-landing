<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::select('id', 'name')->get();

        $productsData = \App\Models\Product::query()
            ->select([
                'id',
                'category_id',
                'name',
                'photo',
                'color_type',
                'print_colors_count',
                'dimensions',
                'complies_with_gost_fefco',
                'specs',
            ])
            ->with('category:id,name')
            ->get()
            ->map(function ($product) {
                return [
                    'key'        => $product->id,
                    'cat'        => mb_strtolower($product->category->name),
                    'title'      => $product->name,
                    'image'      => $product->photo
                        ? asset('storage/' . $product->photo)
                        : 'https://placehold.co/400x300',
                    'color'      => $product->color_type,
                    'print'      => $product->print_colors_count,
                    'dimensions' => $product->dimensions,
                    'gost'       => (bool) $product->complies_with_gost_fefco,
                    'specs'      => $this->mapSpecs($product->specs),
                ];
            })
            ->values();

        $brandingSlides = \App\Models\BrandingImage::query()
            ->where('is_active', true)
            ->pluck('path')
            ->map(fn ($path) => asset('storage/' . $path))
            ->toArray();

        return view('home', [
            'categories'      => $categories,
            'productsData'    => $productsData,
            'firstTab'        => mb_strtolower(optional($categories->first())->name ?? ''),
            'brandingSlides'  => $brandingSlides,
        ]);
    }

    private function mapSpecs(?array $specs): array
    {
        if (empty($specs)) {
            return [];
        }

        $typeMap = [
            '1' => 'micro',
            '2' => 'threeLayer',
            '3' => 'fiveLayer',
        ];

        $result = [];

        foreach ($specs as $spec) {
            $key = $typeMap[(string)($spec['type'] ?? '')] ?? $spec['type'] ?? 'unknown';

            $result[$key] = [
                'profile' => implode(', ', $spec['profiles'] ?? []),
                'grades'  => implode(', ', $spec['grades'] ?? []),
            ];
        }

        return $result;
    }


}
