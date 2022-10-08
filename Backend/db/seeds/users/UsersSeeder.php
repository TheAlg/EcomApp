<?php
declare(strict_types=1);

namespace Base\Seeds\Users;

use Phinx\Seed\AbstractSeed;

final class UsersSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'firstName' => 'Bob',
                'lastName' => 'Burnquist',
                'email' => 'bob@phalcon.io',
                'password' => '$2y$08$L3Vqdk9ydm9PZktqMWRQO.bjO.rV4a7GJACZKEeCskzxWbT570Z2a',
                'mustChangePassword' => 'N',
                'profilesId' => 1,
                'banned' => 'N',
                'suspended' => 'N',
                'active' => 'Y',
            ],
            [
                'id' => 1,
                'firstName' => 'test',
                'lastName' => 'test',
                'email' => 'test@test.com',
                'password' => '$2y$10$0eDq3yszofW3XMNHyY1sz.h8oBGwLUpLmg9J2Njf3cIbKc/bp9crK', //Test123
                'mustChangePassword' => 'N',
                'profilesId' => 1,
                'banned' => 'N',
                'suspended' => 'N',
                'active' => 'Y',
            ],
        ];

        $posts = $this->table('users');
        $posts->insert($data)
            ->saveData();
    }
}
