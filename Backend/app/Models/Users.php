<?php
declare(strict_types=1);


namespace App\Application\Models;

use Phalcon\Mvc\Model;
use Phalcon\Encryption\Security;
use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Uniqueness;
/**
 * All the users registered in the application
 */
class Users extends Model
{

    public $id;

    public $firstName;

    public $lastName;

    public $userName;

    public $email;

    public $password;

    public $mustChangePassword;

    public $profilesId;

    public $banned;

    public $suspended;
    
    public $createdAt;
    
    public $updatedAt;

    public function initialize()
    {
        $this->hasOne('profilesId', Profiles::class, 'id', [
            'alias'    => 'profile',
            'reusable' => true,
        ]);

        $this->hasMany('id', SuccessLogins::class, 'usersId', [
            'alias'      => 'successLogins',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system',
            ],
        ]);

        $this->hasMany('id', PasswordChanges::class, 'usersId', [
            'alias'      => 'passwordChanges',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system',
            ],
        ]);
        $this->hasMany('id', address::class, 'userId', [
            'alias'      => 'address',
            'foreignKey' => [
                'message' => '',
            ],
        ]);
        $this->hasMany('id', payment::class, 'userId', [
            'alias'      => 'payment',
            'foreignKey' => [
                'message' => '',
            ],
        ]);

        $this->hasMany('id', ResetPasswords::class, 'usersId', [
            'alias'      => 'resetPasswords',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system',
            ],
        ]);
    }

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        if (empty($this->password)) {
            // Generate a plain temporary password
            $tempPassword = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(12)));

            // The user must change its password in first login
            $this->mustChangePassword = 'Y';

            /** @var Security $security */
            $security = $this->getDI()->getShared('security');
            // Use this password as default
            $this->password = $security->hash($tempPassword);
        } else {
            // The user must not change its password in first login
            $this->mustChangePassword = 'N';
        }

        // The account must be confirmed via e-mail
        // Only require this if emails are turned on in the config, otherwise account is automatically active
        if ($this->getDI()->get('config')->useMail) {
            $this->active = 'N';
        } else {
            $this->active = 'Y';
        }

        // The account is not suspended by default
        $this->suspended = 'N';

        // The account is not banned by default
        $this->banned = 'N';

        $this->createdAt = date('Y-m-d');
        $this->updatedAt = date('Y-m-d');
        
    }

    /**
     * Send a confirmation e-mail to the user if the account is not active
     */
    public function afterCreate()
    {
        // Only send the confirmation email if emails are turned on in the config
        if ($this->getDI()->get('config')->useMail && $this->active == 'N') {
            $emailConfirmation          = new EmailConfirmations();
            $emailConfirmation->usersId = $this->id;

            if ($emailConfirmation->save()) {
                $this->getDI()
                    ->getFlash()
                    ->notice('A confirmation mail has been sent to ' . $this->email);
            }
        }
    }

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "The email is already registered",
        ]));

        return $this->validate($validator);
    }

    public static function publicUser($id)
    {
        return 
            Users::findFirst([
                'id ='. $id,
                'columns' =>'id, firstName, lastName, email, birthday, isoCode, phoneNumber, profilesId'
            ]);
        ;
    }

}
