<?php

namespace Database\Seeders;

use App\Models\FeedbackCategory;
use Illuminate\Database\Seeder;

class FeedbackCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hạ tầng - đô thị', 'slug' => 'ha-tang-do-thi', 'sort_order' => 10],
            ['name' => 'Môi trường - vệ sinh', 'slug' => 'moi-truong-ve-sinh', 'sort_order' => 20],
            ['name' => 'Văn hóa - xã hội', 'slug' => 'van-hoa-xa-hoi', 'sort_order' => 30],
            ['name' => 'Giáo dục - y tế', 'slug' => 'giao-duc-y-te', 'sort_order' => 40],
            ['name' => 'An ninh - trật tự', 'slug' => 'an-ninh-trat-tu', 'sort_order' => 50],
            ['name' => 'Thủ tục hành chính', 'slug' => 'thu-tuc-hanh-chinh', 'sort_order' => 60],
            ['name' => 'Khác', 'slug' => 'khac', 'sort_order' => 99],
        ];

        foreach ($categories as $category) {
            FeedbackCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [...$category, 'is_active' => true]
            );
        }
    }
}
