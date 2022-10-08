<?php
declare(strict_types=1);

namespace Base\Migrations\users;

use Phinx\Migration\AbstractMigration;

final class CreateResetPasswords extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('reset_passwords');
        if ($table->exists()) {
            return;
        }

        $table->addColumn('usersId', 'integer')
            ->addColumn('code', 'string')
            ->addColumn('createdAt', 'integer')
            ->addColumn('modifiedAt', 'integer',["null" =>true])
            ->addColumn('reset', 'char', ['limit' => 1])
            ->addIndex(['usersId'])
            ->create();
    }
}
