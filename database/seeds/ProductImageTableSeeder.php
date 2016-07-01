<?php

use Illuminate\Database\Seeder;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 18) as $idProduct) {
            factory(CodeCommerce\ProductImage::class)->create([
                    'product_id' => $idProduct,
                    'extension' => 'jpg',
                ]
            );
        }

        factory(CodeCommerce\ProductImage::class, 7)->create();

        $count = 1;
        $dirUploads = public_path('uploads');

        if ($curdir = opendir($dirUploads)) {
            while ($file = readdir($curdir)) {
                if ($file != '.' && $file != '..') {
                    rename($dirUploads . '/' . $file, $dirUploads . '/' . $count . '.jpg');
                    $count++;
                }
            }
            closedir($curdir);
        }
    }
}
