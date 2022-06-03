<?php
namespace Base\Seeds\Banner;

use Phinx\Seed\AbstractSeed;

class BannerSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'picturePath' => 'assets/images/demos/demo-13/slider/slide-1.png',
                'title' => "MacBook Air Latest Model",
                'subtitle' => "Trade-In Offer",
                'newPrice' => 999.99,
                'startDate' =>  date('Y-m-d H:i:s'),
            ],
            [
                'picturePath' => 'assets/images/demos/demo-13/slider/slide-2.jpg',
                'title' => "Original Outdoor Beanbag",
                'subtitle' => "Trevel & Outdoor",
                'oldPrice' => 89.99,
                'newPrice' => 29.99,
                'startDate' =>  date('Y-m-d H:i:s'),
            ],
            [
                'picturePath' => 'assets/images/demos/demo-13/slider/slide-3.jpg',
                'title' => "Tan Suede Biker Jacket",
                'subtitle' => "Fashion Promotions",
                'oldPrice' => 240.00,
                'newPrice' => 180.99,
                'startDate' =>  date('Y-m-d H:i:s'),
            ],
        ];

        $posts = $this->table('banners');
        $posts->insert($data)
            ->saveData();

    }

}
