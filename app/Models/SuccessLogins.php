<?php
declare(strict_types=1);


namespace App\Application\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins
 *
 * This model registers successfully logins registered users have made
 */
class SuccessLogins extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $usersId;

    /**
     * @var string
     */
    public $ipAddress;

    /**
     * @var string
     */
    public $userAgent;

    public function initialize()
    {
        $this->belongsTo('usersId', Users::class, 'id', [
            'alias' => 'user',
        ]);
    }
}
