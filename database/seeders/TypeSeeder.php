<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['ITALIANA', 'FRANCESE', 'GIAPPONESE', 'MESSICANA', 'CINESE', 'AMERICANA', 'INDIANA', 'ALTRO'];

        foreach ($types as $type) {
            $new_type = new Type;
            $new_type->name = $type;
            $new_type->slug = Str::slug($new_type->name, '-');
            $new_type->save();
        }
    }
}
