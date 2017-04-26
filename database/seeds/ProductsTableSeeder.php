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
        // PLJW101
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 101.30 1000 CFM, 30"',
            'sku'             => 'PLJW101.30',
            'asin'            => 'B012HKQ4LO',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 101.36 1000 CFM, 36"',
            'sku'             => 'PLJW101.36',
            'asin'            => 'B012HKQ70C',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 101.42 1000 CFM, 42"',
            'sku'             => 'PLJW101.42',
            'asin'            => 'B012HKQ99Q',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 101.54 2000 CFM, 54"',
            'sku'             => 'PLJW101.54',
            'asin'            => 'B012HKQEA0',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 101.60 2000 CFM, 60"',
            'sku'             => 'PLJW101.60',
            'asin'            => 'B012HKQHE8',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);

        // PLJW102 Models
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 102.30 1000 CFM, 30"',
            'sku'             => 'PLJW102.30',
            'asin'            => 'B012HKREPY',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 102.36 1000 CFM, 36"',
            'sku'             => 'PLJW102.36',
            'asin'            => 'B012HKRHAQ',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 102.42 1000 CFM, 42"',
            'sku'             => 'PLJW102.42',
            'asin'            => 'B012HKPC2Q',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 102.48 1000 CFM, 48"',
            'sku'             => 'PLJW102.48',
            'asin'            => 'B00DH0KB90',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLFW 129E Models    ** BOTH TECHNICALLY INACTIVE ** --adding them for accuracy sake
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLFW 129E.30 900 CFM Wall Range Hood, 30"',
            'sku'             => 'PLFW129E.30',
            'asin'            => 'B00DH0KB90',
            'factory'         => 'feishida',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLFW 129E.36 900 CFM Wall Range Hood, 36"',
            'sku'             => 'PLFW129E.36',
            'asin'            => 'B00DH0KFSC',
            'factory'         => 'feishida',
            'inventory'       => 0
        ]);
         // PLJI 102 Models

                        // PLJI102.36 technically inactive ** out of stock ** still inserted
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 102.36 1200 CFM, 36"',
            'sku'             => 'PLJI102.36',
            'asin'            => 'B012HKPZ0K',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 102.42 1200 CFM, 42"',
            'sku'             => 'PLJI102.42',
            'asin'            => 'B012HKQ1NU',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 102.48 1200 CFM, 48"',
            'sku'             => 'PLJI102.48',
            'asin'            => 'B012HKQ49G',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 102.60 1200 CFM, 60"',
            'sku'             => 'PLJI102.60',
            'factory'         => 'jilu',
            'asin'            => 'B012HKQ6PS',
            'inventory'       => 1
        ]);
         // PLJW108 Models
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 108.30 Professional Range Hood 1000 CFM blower Professional Range Hood, 30"',
            'sku'             => 'PLJW108.30',
            'asin'            => 'B019YIIT24',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW108.36 Inactive(Outofstock)
         DB::table('products')->insert([
            'name'            => 'Professional Range Hood W/1000 CFM Blower PLJW 108.36, 36"',
            'sku'             => 'PLJW108.36',
            'asin'            => 'B019YIIUA0',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Professional Range Hood W/1000 CFM Blower PLJW 108.42, 42"',
            'sku'             => 'PLJW108.42',
            'asin'            => 'B019YIIV5O',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Professional Range Hood W/1000 CFM Blower PLJW 108.48, 48"',
            'sku'             => 'PLJW108.48',
            'asin'            => 'B019YIIWBW',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJI103 Models
                //PLJI 103.36 inactive(outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJI 103.36 1200 CFM Professional Island Range Hood, 36"',
            'sku'             => 'PLJI103.36',
            'asin'            => 'B012HKQKKY',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 103.42 1200 CFM, 42"',
            'sku'             => 'PLJI103.42',
            'asin'            => 'B012HKQN1U',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 103.54 1200 CFM, 54"',
            'sku'             => 'PLJI103.54',
            'asin'            => 'B012HKQS0Q',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Island Range Hood PLJI 103.60 1200 CFM, 60"',
            'sku'             => 'PLJI103.60',
            'asin'            => 'B012HKQUJ0',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLFW129J Models
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLFW 129J.30 900 CFM Wall Range Hood, 30"',
            'sku'             => 'PLFW129J.30',
            'asin'            => 'B00DH0KHXK',
            'factory'         => 'feishida',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLFW 129J.36 900 CFM Wall Range Hood, 36"',
            'sku'             => 'PLFW129J.36',
            'asin'            => 'B00DH0KJ6K',
            'factory'         => 'feishida',
            'inventory'       => 1
        ]);
         // PLJW104 Models
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 104.36 1200 CFM Wall Mount Range Hood, 36"',
            'sku'             => 'PLJW104.36',
            'asin'            => 'B01EV9PKJG',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline PLJW 104 Wall Mount Range Hood PLJW104.42 1200 CFM, 42"',
            'sku'             => 'PLJW104.42',
            'asin'            => 'B01EV9POAQ',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline PLJW 104 Wall Mount Range Hood PLJW104.48 1200 CFM, 48"',
            'sku'             => 'PLJW104.48',
            'asin'            => 'B01EV9PPF0',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline PLJW 104 Wall Mount Range Hood PLJW104.54 1200 CFM, 54"',
            'sku'             => 'PLJW104.54',
            'asin'            => 'B01EV9PQD6',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW104.60 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline PLJW 104 Wall Mount Range Hood PLJW104.60 1200 CFM, 60"',
            'sku'             => 'PLJW104.60',
            'asin'            => 'B01EV9PRT4',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         // PLJW 113
            //PLJW113.30 inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 113.30 900 CFM, 30"',
            'sku'             => 'PLJW113.30',
            'asin'            => 'B00DH0KLAE',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 113.36 900 CFM, 36"',
            'sku'             => 'PLJW113.36',
            'asin'            => 'B01EV9Q9MI',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 113.42 900 CFM, 42"',
            'sku'             => 'PLJW113.42',
            'asin'            => 'B01EV9QAYU',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 113.48 900 CFM, 48"',
            'sku'             => 'PLJW113.48',
            'asin'            => 'B00DGYC4J2',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);

        // PLJW130 Models
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 130.30 900 CFM Wall Chimney Range Hood, 30"',
            'sku'             => 'PLJW130.30',
            'asin'            => 'B01EV9PE2O',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 130.36 900 CFM Wall Chimney Range Hood, 36"',
            'sku'             => 'PLJW 130.36',
            'walmartSKU'             => 'PLJW 130.36',
            'walmartID'             => '170152970',
            'asin'            => 'B01EV9PEWE',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 130.42 1200 CFM Wall Chimney Range Hood, 42"',
            'sku'             => 'PLJW130.42',
            'walmartSKU'         => 'PLJW 130.42',
            'walmartID'         => '172996833',
            'asin'            => 'B01EV9PFWS',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 130.48 1200 CFM Wall Chimney Range Hood, 48"',
            'sku'             => 'PLJW130.48',
            'walmartSKU'         => 'PLJW 130.48',
            'walmartID'         => '199890550',
            'asin'            => 'B01J4EDDI8',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW109 Models
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 109.30 1000 CFM, 30"',
            'sku'             => 'PLJW109.30',
            'walmartSKU'         => 'PLJW 109.30',
            'walmartID'         => '180812455',
            'asin'            => 'B012HKPNOS',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
            //PLJW109.36 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 109.36 1000 CFM, 36"',
            'sku'             => 'PLJW109.36',
            'walmartSKU'         => 'PLJW 109.36',
            'walmartID'         => '107966876',
            'asin'            => 'B00DH0KKC8',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 109.42 1000 CFM, 42"',
            'sku'             => 'PLJW109.42',
            'asin'            => 'B012HKPPZA',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 109.48-2 2000 CFM Wall/Undercabinet Range Hood, 48"',
            'sku'             => 'PLJW109.48',
            'walmartSKU'         => 'PLJW 109.48',
            'walmartID'         => '177655211',
            'asin'            => 'B012HKYKE2',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 109.54 2000 CFM, 54"',
            'sku'             => 'PLJW109.54',
            'walmartSKU'         => 'PLJW 109.54',
            'walmartID'         => '143491520',
            'asin'            => 'B012HKPSSY',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 109.60 2000 CFM, 60"',
            'sku'             => 'PLJW109.60',
            'walmartSKU'         => 'PLJW 109.60',
            'walmartID'         => '113630821',
            'asin'            => 'B012HKPWFS',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW121 Models
            // PLJW121.30 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 121.30 900 CFM, 30"',
            'sku'             => 'PLJW121.30',
            'walmartSKU'         => 'PLJW 121.30',
            'walmartID'         => '164938666',
            'asin'            => 'B015HS4SQG',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 121.36 900 CFM, 36"',
            'sku'             => 'PLJW121.36',
            'asin'            => 'B015HS4TYC',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
            // PLJW121.42 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 121.42 900 CFM Wall/Undercabinet Range Hood, 42"',
            'sku'             => 'PLJW121.42',
            'walmartSKU'         => 'PLJW 121.42',
            'walmartID'         => '157312339',
            'asin'            => 'B012HKPKR8',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
            // PLJW121.48 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 121.48 900 CFM Wall/Undercabinet Range Hood, 48"',
            'sku'             => 'PLJW121.48',
            'asin'            => 'B00DH0K6M2',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         // PLJW125 Models   BOTH MODELS Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Professional Under Cabinet Range Hood PLJW 125.30 900 CFM, 30"',
            'sku'             => 'PLJW125.30',
            'asin'            => 'B01EV9PIMK',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Under Cabinet Range Hood PLJW 125.36 900 CFM, 36"',
            'sku'             => 'PLJW125.36',
            'asin'            => 'B01EV9PJOW',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         // PLJW133 Models
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 133.30 900 CFM, 30"',
            'sku'             => 'PLJW133.30',
            'asin'            => 'B01EV9QJ6E',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 133.36 900 CFM, 36"',
            'sku'             => 'PLJW133.36',
            'asin'            => 'B01EV9QL5S',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW120 Models
            //PLJW120.30 Inactive (outofstock)
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 120.30 900 CFM, 30"',
            'sku'             => 'PLJW120.30',
            'walmartSKU'         => 'PLJW 120.30',
            'walmartID'         => '194142809',
            'asin'            => 'B015GA6ZZM',
            'factory'         => 'jilu',
            'inventory'       => 0
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 120.36 900 CFM, 36"',
            'sku'             => 'PLJW120.36',
            'asin'            => 'B015GA72BS',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 120.42 900 CFM, 42"',
            'sku'             => 'PLJW120.42',
            'walmartSKU'             => 'PLJW120.42',
            'walmartID'             => '148500113',
            'asin'            => 'B012HKPF82',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 120.48 900 CFM, 48"',
            'sku'             => 'PLJW120.48',
            'walmartSKU'         => 'PLJW 120.48',
            'walmartID'         => '121744654',
            'asin'            => 'B012HKPHZI',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW129 Models
         DB::table('products')->insert([
            'name'            => '30" 900 CFM Ducted Wall Mount Range Hood',
            'sku'             => 'PLJW129.30',
            'walmartSKU'             => 'PLJW 129.30',
            'walmartID'             => '177704777',
            'asin'            => 'B015JT8X3C',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Professional Wall Range Hood PLJW 129.36 900 CFM, 36"',
            'sku'             => 'PLJW 129.36',
            'walmartSKU'             => 'PLJW 129.36',
            'walmartID'             => '188395069',
            'asin'            => 'B015JT8YEA',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall Mount Range Hood PLJW 129.42 1800 CFM, 42"',
            'sku'             => 'PLJW129.42',
            'walmartSKU'         => 'PLJW 129.42',
            'walmartID'         => '189151296',
            'asin'            => 'B015JT8ZV2',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => '48" 1200 CFM Ducted Wall Mounted Range Hood',
            'sku'             => 'PLJW129.48',
            'walmartSKU'         => 'PLJW 129.48',
            'walmartID'         => '125496420',
            'asin'            => 'B01KGETW1M',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 185 Models ** MOST POPULAR MODEL **
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 185.30 600 CFM, 30"',
            'sku'             => 'PLJW185.30',
            'walmartSKU'         => 'PLJW 185.30',
            'walmartID'         => '198599594',
            'asin'            => 'B015GEQOTU',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 185.36 600 CFM, 36"',
            'sku'             => 'PLJW185.36',
            'walmartSKU'             => 'PLJW 185.36',
            'walmartID'             => '130901267',
            'asin'            => 'B015GEQPVW',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 117 Models
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 117.30 900 CFM, 30"',
            'sku'             => 'PLJW117.30',
            'asin'            => 'B00ITXHTF4',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 117.30 900 CFM, 36"',
            'sku'             => 'PLJW117.36',
            'asin'            => 'B01EV9QEPA',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 117.42 900 CFM, 42"',
            'sku'             => 'PLJW117.42',
            'asin'            => 'B00ITZ8LW2',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         DB::table('products')->insert([
            'name'            => 'Proline Wall / Undercabinet Range Hood PLJW 117.48 900 CFM, 48"',
            'sku'             => 'PLJW117.48',
            'asin'            => 'B01EV9QI2E',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 108.30
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 180.30 280 CFM Wall/Undercabinet Range Hood, 30"',
            'sku'             => 'PLJW108.30',
            'asin'            => 'B01MDU51YI',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
                 // PLJW 109.42
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 109.42',
            'sku'             => 'PLJW109.42',
            'walmartSKU'            => 'PLJW 109.42',
            'walmartID'            => '178769662',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
                  // PLJW 120.42
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 120.42',
            'sku'             => 'PLJW120.42',
            'walmartSKU'         => 'PLJW 120.42',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
                  // PLJW 120.36
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 120.36',
            'sku'             => 'PLJW120.36',
            'walmartSKU'         => 'PLJW 120.36',
            'walmartID'         => '188254586',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
                  // PLJW 121.36
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 121.36',
            'sku'             => 'PLJW121.36',
            'walmartSKU'         => 'PLJW 121.36',
            'walmartID'         => '111677905',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 121.48
         DB::table('products')->insert([
            'name'            => 'Proline Range Hoods PLJW 121.48',
            'sku'             => 'PLJW121.48',
            'walmartSKU'         => 'PLJW 121.48',
            'walmartID'         => '150843751',
            'inventory'       => 1,
            'factory'         => 'jilu',
        ]);

         // PLJW 129e.36
         DB::table('products')->insert([
            'name'            => 'Proline Wall Mount Range Hood PLJW 129e.36',
            'sku'             => 'PLJW129e.36',
            'walmartSKU'         => 'PLJW 129e.36',
            'walmartID'         => '164838084',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 129e.30
         DB::table('products')->insert([
            'name'            => 'Proline Wall Mount Range Hood PLJW 129e.30',
            'sku'             => 'PLJW129e.30',
            'walmartSKU'         => 'PLJW 129e.30',
            'walmartID'         => '148075004',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
         // PLJW 130.30
         DB::table('products')->insert([
            'name'            => 'Proline Wall Mount Range Hood PLJW 130.30',
            'sku'             => 'PLJW130.30',
            'walmartSKU'         => 'PLJW 130.30',
            'walmartID'         => '119061593',
            'factory'         => 'jilu',
            'inventory'       => 1
        ]);
    }
}
