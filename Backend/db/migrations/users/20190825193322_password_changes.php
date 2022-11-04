<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class PasswordChanges extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('password_changes');


        $table->addColumn('userId', 'integer')
            ->addColumn('ipAddress', 'char', ['limit' => 15])
            ->addColumn('userAgent', 'text')
            ->addColumn('changedAt', 'timestamp')
            ->addIndex(['userId'])
            ->create();

            $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
