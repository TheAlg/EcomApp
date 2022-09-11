<?php
declare(strict_types=1);

namespace Base\Migrations\Cart;

use Phinx\Migration\AbstractMigration;

final class CreditCards extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('creditCards');
        $table->addColumn('userId', 'integer')
            ->addColumn('type', 'string', ['default'=>'CC'] ) //for credit card
            ->addColumn('number', 'string')
            ->addColumn('expiryDate', 'date')
            ->addColumn('name', 'string')
            ->addColumn('default','char',['limit' => 1])
            ->create();
    
        $table->addForeignKey('userId', 'users', ['id'])->save();
    }
}
