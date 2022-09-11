<?php
declare(strict_types=1);

namespace Base\Migrations\users;

use Phinx\Migration\AbstractMigration;

final class Adresses extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('addresses');

        $table->addColumn('addressName', 'string', ['null'=>true, 'default'=> 'default'])
            ->addColumn('userId', 'integer')
            ->addColumn('name', 'string')
            ->addColumn('lastName', 'string')
            ->addColumn('street', 'string')
            ->addColumn('addressComplement', 'string', ['null' => true])
            ->addColumn('city', 'string')
            ->addColumn('default', 'char', ['limit' => 1])
            ->addColumn('postCode', 'integer')


            ->create();

            $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
