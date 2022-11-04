<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class ResetPasswords extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('reset_passwords');
        if ($table->exists()) {
            return;
        }

        $table->addColumn('userId', 'integer')
            ->addColumn('code', 'string')
            ->addColumn('createdAt', 'integer')
            ->addColumn('reset', 'char', ['limit' => 1])
            ->addIndex(['userId'])
            ->create();

            $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
