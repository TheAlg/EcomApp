<?php
namespace Base\Seeds\Products;

use Phinx\Seed\AbstractSeed;

class SizesSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'productId' => 1,
                'size' => "M",
            ],
            [
                'productId' => 1,
                'size' => "L",
            ],
            [
                'productId'=> 2,
                'size' => "M",
            ],
            [
                'productId' =>3,
                'size' => "M",
            ],
            [
                'productId'=>3,
                'size' => "XL",
            ],
            [
                'productId'=>3,
                'size' => "L",
            ],
            [
                'productId'=>5,
                'size' => "M",
            ],
        ];
        $posts = $this->table('sizes');
        $posts->insert($data)
            ->saveData();

    }
}
