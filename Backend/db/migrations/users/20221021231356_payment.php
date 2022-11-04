<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class Payment extends AbstractMigration
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
        $table = $this->table('payment');
        if ($table->exists()) {
            return;
        }
        $table = $this->table('payment');
        $table->addColumn('userId', 'integer')
            ->addColumn('type', 'string', ['limit' => 100])
            ->addColumn('provider', 'string', ['limit' => 100])
            ->addColumn('number', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 20])
            ->addColumn('expiry', 'string', ['limit' => 100])
            ->addColumn('default', 'char', ['limit' => 1])

            ->create();
        $table->addForeignKey('userId', 'users', ['id'])->save();

    }
}
