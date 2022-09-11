<?php
declare(strict_types=1);

namespace Base\Migrations\users;

use Phinx\Migration\AbstractMigration;

final class CreatePasswordChanges extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('password_changes');
        if ($table->exists()) {
            return;
        }

        $table->addColumn('usersId', 'integer')
            ->addColumn('ipAddress', 'char', ['limit' => 15])
            ->addColumn('userAgent', 'text')
            ->addColumn('create_date', 'datetime', ['default' => date('Y-m-d H:i:s')])
            ->addIndex(['usersId'])
            ->create();
    }
}