<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class FailedLogins extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('failed_logins');

        $table->addColumn('userId', 'integer', ['null' => true])
            ->addColumn('ipAddress', 'char', ['limit' => 15])
            ->addColumn('attempted', 'integer')
            ->addIndex(['userId'])
            ->create();
            $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
