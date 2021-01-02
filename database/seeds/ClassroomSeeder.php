<?php

use Illuminate\Database\Seeder; 

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'SIGL1',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'SRIT1',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'TWIN1',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'RETL1',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'SIGL2',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'SRIT2',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'TWIN2',
        ]);

        \App\models\classroom::create([
            'room_id' => $faker->numberBetween(1, 10),
            'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
            'libel' => 'RTEL2',
        ]);
    }
}
