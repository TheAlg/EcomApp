<?php
declare(strict_types=1);

namespace Base\Migrations\users;

use Phinx\Migration\AbstractMigration;

final class CreateSuccessLogins extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('success_logins');

        $table->addColumn('usersId', 'integer')
            ->addColumn('ipAddress', 'char', ['limit' => 15])
            ->addColumn('userAgent', 'text')
            ->addIndex(['usersId'])
            ->create();
    }


}
