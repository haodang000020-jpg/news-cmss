<?php

namespace Database\Seeders;

use App\Models\ProcedureGroup;
use Illuminate\Database\Seeder;

class ProcedureGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Hộ tịch', 'slug' => 'ho-tich', 'sort_order' => 10],
            ['name' => 'Bảo trợ xã hội', 'slug' => 'bao-tro-xa-hoi', 'sort_order' => 20],
            ['name' => 'Người có công', 'slug' => 'nguoi-co-cong', 'sort_order' => 30],
            ['name' => 'Văn hóa', 'slug' => 'van-hoa', 'sort_order' => 40],
            ['name' => 'Giáo dục', 'slug' => 'giao-duc', 'sort_order' => 50],
            ['name' => 'Y tế', 'slug' => 'y-te', 'sort_order' => 60],
            ['name' => 'Dân tộc - Tôn giáo', 'slug' => 'dan-toc-ton-giao', 'sort_order' => 70],
            ['name' => 'Gia đình', 'slug' => 'gia-dinh', 'sort_order' => 80],
        ];

        foreach ($groups as $group) {
            ProcedureGroup::updateOrCreate(
                ['slug' => $group['slug']],
                [
                    'name' => $group['name'],
                    'description' => null,
                    'sort_order' => $group['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
