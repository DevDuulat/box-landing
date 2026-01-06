<?php

namespace App\Services;

use App\Models\BrandingImage;
use App\Models\Category;
use App\Models\Product;

class HomeService
{
    public function getHomeData(): array
    {
        $categories = Category::select('id', 'name')->get();

        return [
            'categories'     => $categories,
            'productsData'   => $this->getProductsData(),
            'firstTab'       => mb_strtolower($categories->first()->name ?? ''),
            'brandingSlides' => $this->getBrandingSlides(),
        ];
    }

    private function getProductsData()
    {
        return Product::query()
            ->select([
                'id',
                'category_id',
                'name',
                'photo',
                'photo_brown',
                'photo_white',
                'color_type',
                'print_colors_count',
                'dimensions',
                'complies_with_gost_fefco',
                'specs',
            ])
            ->with('category:id,name')
            ->get()
            ->map(fn ($product) => [
                'key'        => $product->id,
                'cat'        => mb_strtolower($product->category->name),
                'title'      => $product->name,
                'image'      => $product->photo
                    ? asset('storage/' . $product->photo)
                    : 'https://placehold.co/400x300',
                'photo_brown' => $product->photo_brown ? asset('storage/' . $product->photo_brown) : null,
                'photo_white' => $product->photo_white ? asset('storage/' . $product->photo_white) : null,
                'color'      => $product->color_type,
                'print'      => $product->print_colors_count,
                'dimensions' => $product->dimensions,
                'gost'       => (bool) $product->complies_with_gost_fefco,
                'specs'      => $this->mapSpecs($product->specs),
            ])
            ->values();
    }

    private function getBrandingSlides(): array
    {
        return BrandingImage::where('is_active', true)
            ->pluck('path')
            ->map(fn ($path) => asset('storage/' . $path))
            ->toArray();
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
            $key = $typeMap[(string) ($spec['type'] ?? '')] ?? 'unknown';

            $result[$key] = [
                'profile' => implode(', ', $spec['profiles'] ?? []),
                'grades'  => implode(', ', $spec['grades'] ?? []),
            ];
        }

        return $result;
    }
}
