<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startYear = 2025; // Tahun awal
        $currentYear = date('Y'); // Tahun saat ini
        $years = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[] = ['year' => $year];
        }

        DB::table('years')->insert($years);
    }
}
