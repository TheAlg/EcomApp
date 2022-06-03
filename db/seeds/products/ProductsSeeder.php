<?php
namespace Base\Seeds\Products;

use Phinx\Seed\AbstractSeed;

final class ProductsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'Base\Seeds\Products\CategoriesSeeder',
        ];
    }
    public function run()
    {
        $data = [
            [
                'id' =>1,
                'title'=>'Sweater', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-1.jpg',
            ],
            [
                'id' =>2,
                'title'=>'Survetement', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-2.jpg',
            ],
            [
                'id' =>3,
                'title'=>'Boots', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-3.jpg',
            ],
            [
                'id' =>4,
                'title'=>'Skateboard', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-4.jpg',
            ],
            [
                'id' =>5,
                'title'=>'Sweat', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-6.jpg',
            ],
            [
                'id' =>6,
                'title'=>'Tshirt', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-7.jpg',
            ],
            [
                'id' =>7,
                'title'=>'Joging', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-8.jpg',
            ],
            [
                'id' =>8,
                'title'=>'Survetement', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-9.jpg',
            ],
            [
                'id' =>9,
                'title'=>'Tshirt', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-10.jpg',
            ],
            [
                'id' =>10,
                'title'=>'Halouma', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-11.jpg',
            ],
            [
                'id' =>11,
                'title'=>'boots', 
                'categoryId'=> 4,
                'picturePath' => '/assets/images/products/product-12.jpg',
            ],
            [
                'id' =>12,
                'title'=>'Sneakers', 
                'categoryId'=> 4,
                'picturePath' =>  '/assets/images/products/product-13.jpg',
            ],
            [
                'id' =>13,
                'title'=>'Butler Stool Ladder', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-1.jpg',
                'sale' => 'Y'
            ],
            [
                'id' =>14,
                'title'=>'Bose - SoundSport  wireless headphones', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-2.jpg',
                'sale' => 'Y',
                'top' => 'Y',
            ],
            [
                'id' =>15,
                'title'=>'Bose - Can 2-Seater Sofa frame charcoal', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-3.jpg',
                'sale' => 'Y',
            ],
            [
                'id' =>16,
                'title'=>'Tan suede biker jacket', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-4.jpg',
                'sale' => 'Y',
            ],
            [
                'id' =>17,
                'title'=>'Sony - Class LED 2160p Smart 4K Ultra HD', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-5.jpg',
                'sale' => 'Y',
                'top' => 'Y',
            ],
            [
                'id' =>18,
                'title'=>'Neato Robotics', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-6.jpg',
                'new' => 'Y',
            ],
            [
                'id' =>19,
                'title'=>'MacBook Pro 13" Display, i5', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-7.jpg',
                'top' => 'Y',
            ],
            [
                'id' =>20,
                'title'=>'Bose - SoundLink Bluetooth Speaker', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-8.jpg',
            ],
            [
                'id' =>21,
                'title'=>'Apple - 11 Inch iPad Pro  with Wi-Fi 256GB ', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-9.jpg',
                'new' => 'Y',
            ],
            [
                'id' =>22,
                'title'=>'Google - Pixel 3 XL 128GB', 
                'categoryId'=> 1,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-10.jpg',
                'sale' => 'Y',
            ],
            [
                'id' =>23,
                'title'=>'Block Side Table/Trolley', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-11.jpg',
                'new' => 'Y',
            ],
            [
                'id' =>24,
                'title'=>'Roots Sofa Bed', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-12.jpg',
            ],
            [
                'id' =>25,
                'title'=>'Carronade Large Suspension Lamp', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-13.jpg',
                'new'=> 'Y',
            ],
            [
                'id' =>26,
                'title'=>'Wingback Chair', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-14.jpg',
            ],
            [
                'id' =>27,
                'title'=>'Flow Slim Armchair', 
                'categoryId'=> 5,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-15.jpg',
                'sale'=>'Y'
            ],
            [
                'id' =>28,
                'title'=>'Beige faux suede runner  trainers', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-16.jpg',
            ],
            [
                'id' =>29,
                'title'=>'Black boucle check scarf', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-17.jpg',
                'new'=>'Y',
            ],
            [
                'id' =>30,
                'title'=>'Red stripe tie front shirt', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-18.jpg',
            ],
            [
                'id' =>31,
                'title'=>'Triple compartment  cross body bag', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-19.jpg',
            ],
            [
                'id' =>32,
                'title'=>'Oxford grandad shirt', 
                'categoryId'=> 2,
                'picturePath' =>  '/assets/images/demos/demo-13/products/product-20.jpg',
            ],
        ];

        $posts = $this->table('products');
        $posts->insert($data)
            ->saveData();
    }
}
