<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => [
                    'ru' => 'Короб',
                    'kg' => 'Cебет' // Замените на корректный перевод
                ]
            ],
            [
                'name' => [
                    'ru' => 'Короб для пиццы',
                    'kg' => 'Пицца үчүн себет'
                ]
            ],
            [
                'name' => [
                    'ru' => 'Лоток',
                    'kg' => 'Жайма'
                ]
            ],
            [
                'name' => [
                    'ru' => 'Элементы',
                    'kg' => 'Элементтер'
                ]
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name->ru' => $category['name']['ru']],
                ['name' => $category['name']]
            );
        }
    }
}