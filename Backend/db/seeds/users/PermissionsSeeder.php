<?php
declare(strict_types=1);

namespace Base\Seeds\Users;

use Phinx\Seed\AbstractSeed;

final class PermissionsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'Base\Seeds\Users\ProfilesSeeder',
        ];
    }
    public function run(): void
    {
        $data = [
            [
                'id'=>1,
                'profileId' => 3,
                'resource' => 'users',
                'action' => 'index',
            ],
            [
                'id' => 2,
                'profileId' => 3,
                'resource' => 'users',
                'action' => 'search',
            ],
            [
                'id' => 3,
                'profileId' => 3,
                'resource' => 'profiles',
                'action' => 'index',
            ],
            [
                'id' => 4,
                'profileId' => 3,
                'resource' => 'profiles',
                'action' => 'search',
            ],
            [
                'id' => 5,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'index',
            ],
            [
                'id' => 6,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'search',
            ],
            [
                'id' => 7,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'edit',
            ],
            [
                'id' => 8,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'create',
            ],
            [
                'id' => 9,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'delete',
            ],
            [
                'id' => 10,
                'profileId' => 1,
                'resource' => 'users',
                'action' => 'changePassword',
            ],
            [
                'id' => 11,
                'profileId' => 1,
                'resource' => 'profiles',
                'action' => 'index',
            ],
            [
                'id' => 12,
                'profileId' => 1,
                'resource' => 'profiles',
                'action' => 'search',
            ],
            [
                'id' => 13,
                'profileId' => 1,
                'resource' => 'profiles',
                'action' => 'edit',
            ],
            [
                'id' => 14,
                'profileId' => 1,
                'resource' => 'profiles',
                'action' => 'create',
            ],
            [
                'id' => 15,
                'profileId' => 1,
                'resource' => 'profiles',
                'action' => 'delete',
            ],
            [
                'id' => 16,
                'profileId' => 1,
                'resource' => 'permissions',
                'action' => 'index',
            ],
            [
                'id' => 17,
                'profileId' => 2,
                'resource' => 'users',
                'action' => 'index',
            ],
            [
                'id' => 18,
                'profileId' => 2,
                'resource' => 'users',
                'action' => 'search',
            ],
            [
                'id' => 19,
                'profileId' => 2,
                'resource' => 'users',
                'action' => 'edit',
            ],
            [
                'id' => 20,
                'profileId' => 2,
                'resource' => 'users',
                'action' => 'create',
            ],
            [
                'id' => 21,
                'profileId' => 2,
                'resource' => 'profiles',
                'action' => 'index',
            ],
            [
                'id' => 22,
                'profileId' => 2,
                'resource' => 'profiles',
                'action' => 'search',
            ],
        ];

        $posts = $this->table('permissions');
        $posts->insert($data)
            ->saveData();
    }
}
