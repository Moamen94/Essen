<?php

namespace Database\Seeders;

use App\Models\FoodItem;
use Illuminate\Database\Seeder;

class FoodItemSeeder extends Seeder
{
    public function run(): void
    {
$items = [
    [
        'name' => 'شاورما دجاج',
        'description' => 'دجاج مشوي مع تتبيلة خاصة، مع طحينة، مخلل، وخبز عربي طازج.',
        'price' => 8.50,
        'rating' => 5,
        'restaurant_name' => 'مطعم الرفاعي'
    ],
    [
        'name' => 'منسف أردني',
        'description' => 'لحم الضأن مع الأرز والجميد، يقدم مع الصلصة التقليدية والمكسرات.',
        'price' => 18.00,
        'rating' => 5,
        'restaurant_name' => 'مطعم جواد'
    ],
    [
        'name' => 'محمرة مع خبز',
        'description' => 'فطائر محشوة بالفلفل الأحمر، الطحينة، والمكسرات، تقدم مع الخبز العربي.',
        'price' => 7.50,
        'rating' => 4,
        'restaurant_name' => 'مطعم جودت'
    ],
    [
        'name' => 'فلافل',
        'description' => 'كرات الحمص المقلية مع الثوم، الكمون، الكزبرة، تقدم مع الطحينة والمخلل.',
        'price' => 5.00,
        'rating' => 4.5,
        'restaurant_name' => 'مطعم أبو زيد'
    ],
    [
        'name' => 'سلطة فتوش',
        'description' => 'خضار طازجة مع خبز محمص وصلصة دبس الرمان وزيت الزيتون.',
        'price' => 6.00,
        'rating' => 4,
        'restaurant_name' => 'مطعم الهاشمي'
    ],
    [
        'name' => 'سوشي رول',
        'description' => 'مزيج من الأسماك والخضار ملفوفة في الأعشاب البحرية والأرز.',
        'price' => 15.99,
        'rating' => 4.8,
        'restaurant_name' => 'مطعم سووشي كافيه'
    ],
    [
        'name' => 'شاورما لحم',
        'description' => 'لحم مشوي مع تتبيلة خاصة، طحينة، مخلل، وخبز عربي طازج.',
        'price' => 9.00,
        'rating' => 4.7,
        'restaurant_name' => 'مطعم البرج'
    ],
];


        foreach ($items as $item) {
            FoodItem::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
