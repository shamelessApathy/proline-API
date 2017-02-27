<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
            'name' => 'Proline Wall / Undercabinet Range Hood PLJW 101.60 2000 CFM, 60"',
            'sku' => 'PLJW101.60',
            'asin' => 'B012HKQHE8',
            'inventory' => 1
        ]);
         DB::table('products')->insert([
            'name' => 'Proline Range Hoods PLJW 104.36 1200 CFM Wall Mount Range Hood, 36"',
            'sku' => 'PLJW104.36',
            'asin' => 'B01EV9PKJG',
            'inventory' => 1
        ]);
         DB::table('products')->insert([
            'name' => 'Proline Wall / Undercabinet Range Hood PLJW 102.48 1000 CFM, 48"',
            'sku' => 'PLJW102.48',
            'asin' => 'B00DH0KB90',
            'inventory' => 1
        ]);
    }
}
