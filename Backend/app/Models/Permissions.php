<?php
declare(strict_types=1);


namespace App\Application\Models;

use Phalcon\Mvc\Model;

/**
 * Permissions
 *
 * Stores the permissions by profile
 */
class Permissions extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $profilesId;

    /**
     * @var string
     */
    public $resource;

    /**
     * @var string
     */
    public $action;

    public function initialize()
    {
        $this->belongsTo('profilesId', Profiles::class, 'id', [
            'alias' => 'profile',
        ]);
    }
}
