<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeCommerce\Product::class, 20)->create()->each(function ($p) {
            $max = mt_rand(1, 10);

            while ($max--) {
                $idTags[] = mt_rand(1, 10);
            }

            $idTags = array_unique($idTags);
            $p->tags()->sync($idTags);
        });
    }
}
