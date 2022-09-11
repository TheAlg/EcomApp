<?php
namespace Base\Seeds\Products;

use Phinx\Seed\AbstractSeed;

class ColorsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'Base\Seeds\Products\ProductsSeeder',
        ];
    }
    
    public function run()
    {
        $data = [
            [
                'productId' => 1,
                'color' => "red",
            ],
            [
                'productId'=> 1,
                'color' => "yellow",
            ],
            [
                'productId' =>3,
                'color' => "grey",
            ],
            [
                'productId'=>3,
                'color' => "black",
            ],
            [
                'productId'=>5,
                'color' => "green",
            ],
            [
                'productId'=>14,
                'color' => "#ff887f",
            ],
            [
                'productId'=>14,
                'color' => "#333333",
            ],
            [
                'productId'=>15,
                'color' => "#b58555",
            ],
            [
                'productId'=>15,
                'color' => "#93a6b0",
            ],
            [
                'productId'=>16,
                'color' => "#b58555",
            ],
            [
                'productId'=>16,
                'color' => "#93a6b0",
            ],
            [
                'productId'=>21,
                'color' => "#eaeaec",
            ],
            [
                'productId'=>21,
                'color' => "#333333",
            ],
            [
                'productId'=>22,
                'color' => "#eaeaec",
            ],
            [
                'productId'=>22,
                'color' => "#333333",
            ],
            [
                'productId'=>23,
                'color' => "#eaeaec",
            ],
            [
                'productId'=>23,
                'color' => "#333333",
            ],
            [
                'productId'=>25,
                'color' => "#dddad5",
            ],
            [
                'productId'=>25,
                'color' => "#825a45",
            ],
            [
                'productId'=>26,
                'color' => "#999999",
            ],
            [
                'productId'=>26,
                'color' => "#cc9999",
            ],
            [
                'productId'=>30,
                'color' => "#dddad5",
            ],
            [
                'productId'=>30,
                'color' => "#825a45",
            ],
            [
                'productId'=>31,
                'color' => "#f1f1f1",
            ],
            [
                'productId'=>31,
                'color' => "#333333",
            ],
            [
                'productId'=>32,
                'color' => "#b8b8b8",
            ],
            [
                'productId'=>32,
                'color' => "#ebebeb",
            ],
        ];
        $posts = $this->table('colors');
        $posts->insert($data)
            ->saveData();

    }

}
