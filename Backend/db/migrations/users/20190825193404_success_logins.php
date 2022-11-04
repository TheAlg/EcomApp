<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class SuccessLogins extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('success_logins');
        if ($table->exists()) {
            return;
        }

        $table->addColumn('userId', 'integer')
            ->addColumn('ipAddress', 'char', ['limit' => 15])
            ->addColumn('userAgent', 'text')
            ->addIndex(['userId'])
            ->create();

        $table->addForeignKey('userId', 'users', ['id'])->save();
    }


}
