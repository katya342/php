<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем существующие записи в таблице перед заполнением
        Plan::query()->delete();

        // Добавляем новые записи
        Plan::create([
            'name' => 'Новичок',
            'price' => 33.22,
            'duration_months' => 1,
        ]);

        Plan::create([
            'name' => 'Улучшение выносливости',
            'price' => 19.99,
            'duration_months' => 2,
        ]);

        Plan::create([
            'name' => 'Кардио без оборудования',
            'price' => 14.99,
            'duration_months' => 1,
        ]);

        // Добавьте дополнительные записи для других планов

        $this->command->info('Таблица plans заполнена данными!');
    }
}
