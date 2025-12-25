<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{


        public function run(): void
    {
        // Находим категории по именам (которые создал CategorySeeder)
        $catBox = Category::where('name', 'Короб')->first();
        $catPizza = Category::where('name', 'Короб для пиццы')->first();
        $catTray = Category::where('name', 'Лоток')->first();
        $catElem = Category::where('name', 'Элементы')->first();

        // 1. КОРОБА
        Product::create([
            'category_id' => $catBox->id,
            'name' => '4-х клапанный стандарт',
            'specs' => [
                [
                    'type' => 2, // Трехслойный
                    'profiles' => ['B', 'C'],
                    'grades' => ['Т-21', 'Т-22', 'Т-23', 'Т-24']
                ],
                [
                    'type' => 3, // Пятислойный
                    'profiles' => ['BC', 'CE'],
                    'grades' => ['П-31', 'П-32']
                ]
            ],
            'color_type' => 'Бурый / Белый',
            'dimensions' => 'По требованию заказчика',
        ]);

        Product::create([
            'category_id' => $catBox->id,
            'name' => 'Архивный короб',
            'specs' => [
                [
                    'type' => 2,
                    'profiles' => ['B'],
                    'grades' => ['Т-23']
                ]
            ],
            'color_type' => 'Бурый',
        ]);

        // 2. ПИЦЦА (Микрокартон)
        Product::create([
            'category_id' => $catPizza->id,
            'name' => 'Для пиццы 30 см',
            'specs' => [
                [
                    'type' => 1, // Микрокартон
                    'profiles' => ['E'],
                    'grades' => ['Т-11', 'Т-12']
                ]
            ],
            'color_type' => 'Белый / Белый',
            'dimensions' => '300x300x40 мм',
        ]);

        // 3. ЛОТОК
        Product::create([
            'category_id' => $catTray->id,
            'name' => 'Кондитерский телевизор',
            'specs' => [
                [
                    'type' => 1,
                    'profiles' => ['E'],
                    'grades' => ['Т-11']
                ],
                [
                    'type' => 2,
                    'profiles' => ['B'],
                    'grades' => ['Т-22']
                ]
            ],
            'color_type' => 'Белый',
        ]);

        // 4. ЭЛЕМЕНТЫ
        Product::create([
            'category_id' => $catElem->id,
            'name' => 'Защитный уголок',
            'specs' => [
                [
                    'type' => 2,
                    'profiles' => ['C'],
                    'grades' => ['Т-24']
                ]
            ],
            'color_type' => 'Бурый',
        ]);
    }
}
