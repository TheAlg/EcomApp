<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class Permissions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $table = $this->table('permissions');
        $table->addColumn('profileId', 'integer')
            ->addColumn('resource', 'string', ['limit' => 100])
            ->addColumn('action', 'string', ['limit' => 100])
            ->create();

        $table->addForeignKey('profileId', 'profiles', ['id'])->save();

    }
}
