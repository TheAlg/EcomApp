<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class RememberTokens extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('remember_tokens');
        if ($table->exists()) {
            return;
        }

        $table->addColumn('userId', 'integer')
            ->addColumn('token', 'char', ['limit' => 32])
            ->addColumn('userAgent', 'text')
            ->addIndex(['token'])
            ->create();

            $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
