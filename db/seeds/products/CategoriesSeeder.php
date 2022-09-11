<?php
namespace Base\Seeds\Products;

use Phinx\Seed\AbstractSeed;

class CategoriesSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => "Electronics",
            ],
            [
                'id'=> 2,
                'name' => "Clothing",
            ],
            [
                'id' =>3,
                'name' => "Life Style",
            ],
            [
                'id'=>4,
                'name' => "Cooking",
            ],
            [
                'id'=>5,
                'name' => "Furniture",
            ],
        ];

        $posts = $this->table('categories');
        $posts->insert($data)
            ->saveData();

    }

}
