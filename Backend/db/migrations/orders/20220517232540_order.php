<?php
declare(strict_types=1);

namespace Base\Migrations\Order;

use Phinx\Migration\AbstractMigration;

final class Order extends AbstractMigration
{
    public function change(){

        $table = $this->table('order');
        $table->addColumn('userId', 'integer')
            ->addColumn('total', 'integer')
            ->addColumn('payment_details', 'integer')
            ->addColumn('createdAt', 'timestamp')
            ->addColumn('modifiedAt', 'timestamp')
            ->create();
    
        $table->addForeignKey('userId', 'users', ['id'])->save();
    }
}
