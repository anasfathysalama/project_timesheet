<?php

namespace Database\Seeders;

use App\Enums\AttributeTypeEnum;
use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'department' => AttributeTypeEnum::TEXT,
            'start_date' => AttributeTypeEnum::DATE,
            'end_date' => AttributeTypeEnum::DATE
        ];

        foreach ($attributes as $attribute => $type) {
            Attribute::create(['name' => $attribute, 'type' => $type]);
        }
    }
}
