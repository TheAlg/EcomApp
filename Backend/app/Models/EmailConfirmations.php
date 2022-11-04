<?php
declare(strict_types=1);


namespace App\Application\Models;

use Phalcon\Mvc\Model;

/**
 * EmailConfirmations
 * Stores the reset password codes and their evolution
 *
 * @method static EmailConfirmations findFirstByCode(string $code)
 * @property Users $user
 */
class EmailConfirmations extends Model
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
    public $code;

    /**
     * @var string
     */
    public $confirmed;

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
        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->confirmed = 'N';
    }

    /**
     * Send a confirmation e-mail to the user after create the account
     */
    public function afterCreate()
    {
        $this->getDI()
             ->getMail()
             ->send([
                 $this->user->email => $this->user->firstName,
             ], "Please confirm your email", 'confirmation', [
                 'confirmUrl' => '/check-request/confirmEmail/' . $this->code . '/' . $this->user->email,
             ])
        ;
    }
}
