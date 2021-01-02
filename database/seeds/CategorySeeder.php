<?php

use App\models\subject;
use App\models\category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $category = ["Mathématiques", "Physqiue", "Informatique", "Langues"];
        $subject = ["Algèbre", "Optique Géométrique", "Algorithme", "Français", "Analyse 1", "Electronique", "Génie Logiciel", "Anglais"];
        $faker = Faker\Factory::create();

        for ($i=0, $j=0; $i <4 ; $i++) {
            $code = $faker->unique()->regexify('[A-Z][0-9]{3}') ;

            category::create(["code"=> $code, "libel"=> $category[$i]])->subject()->save(
                subject::create(["code" => $faker->unique()->regexify('[A-Z][0-9]{3}'), "libel" => $subject[$i] ])
            );
            category::where("code", $code)->first()->subject()->save(
                subject::create(["code" => $faker->unique()->regexify('[A-Z][0-9]{3}'), "libel" => $subject[($i+4)] ])
            );
        }
    }
}
