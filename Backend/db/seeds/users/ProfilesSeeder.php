<?php
declare(strict_types=1);

namespace Base\Seeds\Users;

use Phinx\Seed\AbstractSeed;

final class ProfilesSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Administrators',
            ],
            [
                'id' => 2,
                'name' => 'Users',
            ],
            [
                'id' => 3,
                'name' => 'Read-Only',
            ],
        ];

        $posts = $this->table('profiles');
        $posts->insert($data)
            ->saveData();
    }
}
