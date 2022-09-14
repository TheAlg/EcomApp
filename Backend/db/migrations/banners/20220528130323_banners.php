<?php
declare(strict_types=1);

namespace Base\Migrations\Banner;

use Phinx\Migration\AbstractMigration;

final class Banners extends AbstractMigration
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
        $table = $this->table('banners');
        $table->addColumn('picturePath', 'string')
            ->addColumn('title', 'string')
            ->addColumn('subtitle', 'string', ['null' => true])
            ->addColumn('oldPrice', 'double', ['null' => true])
            ->addColumn('newPrice', 'double')
            ->addColumn('startDate', 'datetime', ['default' => date('Y-m-d H:i:s')])
            ->addColumn('expireDate', 'datetime', ['default' => date('2030-01-01 00:00:00')])
            ->create();
    }
}
