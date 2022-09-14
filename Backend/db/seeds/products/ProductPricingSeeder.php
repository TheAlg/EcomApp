<?php
namespace Base\Seeds\Products;

use Phinx\Seed\AbstractSeed;

class ProductPricingSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'productId'=> 1,
                'basePrice'=> 20.00,
            ],
            [
                'productId'=> 2,
                'basePrice'=> 30.00,
            ],
            [
                'productId'=>3, 
                'basePrice'=> 60.00,
            ],
            [
                'productId'=>4, 
                'basePrice'=> 40.00,
            ],
            [
                'productId'=>5, 
                'basePrice'=> 50.00,
            ],
            [
                'productId'=>6, 
                'basePrice'=> 60.00,
            ],
            [
                'productId'=>7, 
                'basePrice'=> 70.00
            ],
            [
                'productId'=>8,
                'basePrice'=> 80.00,
            ],
            [
                'productId'=>9, 
                'basePrice'=> 90.00,
            ],
            [
                'productId'=>10, 
                'basePrice'=> 100.00
            ],
            [
                'productId'=>11,
                'basePrice'=> 120.00
            ],
            [
                'productId'=>12,
                'basePrice'=> 130.00
            ],
            [
                'productId'=> 13,
                'basePrice'=> 290.00,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 13,
                'basePrice'=> 251.99,
                'inActive' => 'Y', //for current price
            ],
            [
                'productId'=> 14,
                'basePrice'=> 199.99,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 14,
                'basePrice'=> 179.99,
                'inActive' => 'Y', //for current price
            ],
            [
                'productId'=> 15,
                'basePrice'=> 3200.00,
                'inActive'=> 'L', //for last price
                'expiry_date' => '2022-12-30 00:00:00',
            ],
            [
                'productId'=> 15,
                'basePrice'=> 3050.00,
                'inActive' => 'Y', //for current price
            ],
            [
                'productId'=> 16,
                'basePrice'=> 310.00,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 16,
                'basePrice'=> 240.00,
                'inActive' => 'Y', //for current price
            ],
            [
                'productId'=> 17,
                'basePrice'=> 1999.99,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 17,
                'basePrice'=> 1699.99,
                'inActive' => 'Y', //for current price
                'expiry_date' => '2022-09-01 00:00:00',
            ],
            [
                'productId'=> 18,
                'basePrice'=> 399.00,
            ],
            [
                'productId'=> 19,
                'basePrice'=> 1199.00,
            ],
            [
                'productId'=> 20,
                'basePrice'=> 79.99,
            ],
            [
                'productId'=> 21,
                'basePrice'=> 899.99,
            ],
            [
                'productId'=> 22,
                'basePrice'=> 350,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 22,
                'basePrice'=> 410,
                'inActive' => 'Y', //for current price
                'expiry_date' => '2022-10-01 00:00:00',
            ],
            [
                'productId'=> 23,
                'basePrice'=> 229,
            ],
            [
                'productId'=> 24,
                'basePrice'=> 1199.99,
            ],
            [
                'productId'=> 25,
                'basePrice'=> 939,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 25,
                'basePrice'=> 892,
                'inActive' => 'Y', //for current price
                'expiry_date' => '2022-10-01 00:00:00',
            ],
            [
                'productId'=> 26,
                'basePrice'=> 210,
            ],
            [
                'productId'=> 27,
                'basePrice'=> 820,
                'inActive'=> 'L', //for last price
                'expiry_date' =>  date('Y-m-d H:i:s'),
            ],
            [
                'productId'=> 27,
                'basePrice'=> 737,
                'inActive' => 'Y', //for current price
                'expiry_date' => '2022-10-01 00:00:00',
            ],
            [
                'productId'=> 28,
                'basePrice'=> 64,
            ],
            [
                'productId'=> 29,
                'basePrice'=> 36,
            ],
            [
                'productId'=> 30,
                'basePrice'=> 56,
            ],
            [
                'productId'=> 31,
                'basePrice'=> 64,
            ],
            [
                'productId'=> 32,
                'basePrice'=> 44,
            ],
            
            
            
            
        ];

        $posts = $this->table('productPricing');
        $posts->insert($data)
            ->saveData();

    }
    public function getDependencies()
    {
        return [
            'Base\Seeds\Products\ProductsSeeder',
        ];
    }
}
