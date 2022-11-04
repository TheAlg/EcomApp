<?php
declare(strict_types=1);


namespace App\Application\Models;

use Phalcon\Mvc\Model;

/**
 * ResetPasswords
 * Stores the reset password codes and their evolution
 *
 * @method static ResetPasswords findFirstByCode(string $code)
 */
class ResetPasswords extends Model
{
    public $id;

    public $usersId;

    public $code;

    public $createdAt;

    public $reset;

    public function initialize()
    {
        $this->belongsTo('usersId', Users::class, 'id', [
            'alias' => 'user',
        ]);
    }

    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmation
        $this->createdAt = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', \base64_encode(\openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->reset = 'N';
    }

    /**
     * Send an e-mail to users allowing him/her to reset his/her password
     */
    public function afterCreate()
    {
        $this->getDI()
             ->getMail()
             ->send(
                [ $this->user->email => $this->user->firstName], //to
                "Reset your password", //subject
                'reset', //name
                ['resetUrl' => '/check-request/resetPassword/' . $this->code . '/' . $this->user->email]) //params
        ;
    }
}
