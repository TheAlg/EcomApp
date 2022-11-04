<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class EmailConfirmations extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('email_confirmations');

        $table->addColumn('userId', 'integer')
            ->addColumn('code', 'char', ['limit' => 32])
            ->addColumn('confirmed', 'char', ['limit' => 1, 'default' => 'N'])
            ->addIndex(['userId'])
            ->create();
            

        $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
