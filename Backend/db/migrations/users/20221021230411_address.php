<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

class Address extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('address');
        if ($table->exists()) {
            return;
        }
        $table = $this->table('address');
        $table->addColumn('userId', 'integer')
            ->addColumn('street', 'string', ['limit' => 100])
            ->addColumn('complement', 'string', ['limit' => 255, 'null' =>true])
            ->addColumn('city', 'char', ['limit' => 100])
            ->addColumn('postCode', 'string', ['limit' => 100])
            ->addColumn('default', 'char', ['limit' => 3])
            ->create();
        $table->addForeignKey('userId', 'users', ['id'])->save();
    }
}
