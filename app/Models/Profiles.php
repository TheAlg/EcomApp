<?php
declare(strict_types=1);

namespace App\Application\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;


class Profiles extends Model
{
    /**
     * ID
     *
     * @var integer
     */
    public $id;

    /**
     * Name
     *
     * @var string
     */
    public $name;

    /**
     * Define relationships to Users and Permissions
     */
    public function initialize()
    {
        $this->hasMany('id', Users::class, 'profilesId', [
            'alias'      => 'users',
            'foreignKey' => [
                'message' => 'Profile cannot be deleted because it\'s used on Users',
            ],
        ]);

        $this->hasMany('id', Permissions::class, 'profilesId', [
            'alias'      => 'permissions',
            'foreignKey' => [
                'action' => Relation::ACTION_CASCADE,
            ],
        ]);
    }
}
