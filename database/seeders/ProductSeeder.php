<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Находим категории, используя поиск по JSON ключу 'ru'
        $catBox = Category::where('name->ru', 'Короб')->first();
        $catPizza = Category::where('name->ru', 'Короб для пиццы')->first();
        $catTray = Category::where('name->ru', 'Лоток')->first();
        $catElem = Category::where('name->ru', 'Элементы')->first();

        // 1. КОРОБА
        Product::create([
            'category_id' => $catBox->id,
            'name' => [
                'ru' => '4-х клапанный стандарт',
                'kg' => '4 клапандуу стандарт'
            ],
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
            'color_type' => [
                'ru' => 'Бурый / Белый',
                'kg' => 'Күрөң / Ак'
            ],
            'dimensions' => [
                'ru' => 'По требованию заказчика',
                'kg' => 'Буйрутмачынын талабы боюнча'
            ],
        ]);

        Product::create([
            'category_id' => $catBox->id,
            'name' => [
                'ru' => 'Архивный короб',
                'kg' => 'Архив кутусу'
            ],
            'specs' => [
                [
                    'type' => 2,
                    'profiles' => ['B'],
                    'grades' => ['Т-23']
                ]
            ],
            'color_type' => [
                'ru' => 'Бурый',
                'kg' => 'Күрөң'
            ],
            'dimensions' => [
                'ru' => 'Стандарт',
                'kg' => 'Стандарт'
            ],
        ]);

        // 2. ПИЦЦА
        Product::create([
            'category_id' => $catPizza->id,
            'name' => [
                'ru' => 'Для пиццы 30 см',
                'kg' => 'Пицца үчүн 30 см'
            ],
            'specs' => [
                [
                    'type' => 1, // Микрокартон
                    'profiles' => ['E'],
                    'grades' => ['Т-11', 'Т-12']
                ]
            ],
            'color_type' => [
                'ru' => 'Белый / Белый',
                'kg' => 'Ак / Ак'
            ],
            'dimensions' => [
                'ru' => '300x300x40 мм',
                'kg' => '300x300x40 мм'
            ],
        ]);

        // 3. ЛОТОК
        Product::create([
            'category_id' => $catTray->id,
            'name' => [
                'ru' => 'Кондитерский телевизор',
                'kg' => 'Кондитердик телевизор'
            ],
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
            'color_type' => [
                'ru' => 'Белый',
                'kg' => 'Ак'
            ],
            'dimensions' => [
                'ru' => 'По размерам',
                'kg' => 'Өлчөмдөрү боюнча'
            ],
        ]);

        // 4. ЭЛЕМЕНТЫ
        Product::create([
            'category_id' => $catElem->id,
            'name' => [
                'ru' => 'Защитный уголок',
                'kg' => 'Коргоочу бурч'
            ],
            'specs' => [
                [
                    'type' => 2,
                    'profiles' => ['C'],
                    'grades' => ['Т-24']
                ]
            ],
            'color_type' => [
                'ru' => 'Бурый',
                'kg' => 'Күрөң'
            ],
            'dimensions' => [
                'ru' => 'Различные',
                'kg' => 'Ар кандай'
            ],
        ]);
    }
}