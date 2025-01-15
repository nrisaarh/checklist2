<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pic;

class PicSeeder extends Seeder
{
    public function run()
    {
        $pics = ['Mifta', 'Tegar', 'Budi', 'Siti', 'Andi'];
        foreach ($pics as $name) {
            Pic::create(['name' => $name]);
        }
    }
}
