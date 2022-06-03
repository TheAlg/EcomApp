<?php
declare(strict_types=1);

namespace App\Application\Models;

use Phalcon\Mvc\Model;

/**
 * RememberTokens
 * Stores the remember me tokens
 */
class RememberTokens extends Model
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
    public $token;

    /**
     * @var string
     */
    public $userAgent;

    /**
     * @var integer
     */
    public $createdAt;

    public function initialize()
    {
        $this->belongsTo('usersId', Users::class, 'id', [
            'alias' => 'user',
        ]);
    }

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmation
        $this->createdAt = time();
    }
}
