<?php
declare(strict_types=1);

namespace App\Application\Models;

use Phalcon\Mvc\Model;

class FailedLogins extends Model
{
    public $id;
    public $usersId;
    public $ipAddress;
    public $attempted;

    public function initialize()
    {
        $this->belongsTo('usersId', Users::class, 'id', 
        [
            'alias' => 'user',
        ]);
    }
}
