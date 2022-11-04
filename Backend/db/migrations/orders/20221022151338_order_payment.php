<?php
declare(strict_types=1);

namespace Base\Migrations\Order;

use Phinx\Migration\AbstractMigration;

final class orderPayment extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('order_payment');
        $table->addColumn('orderId', 'integer')
            ->addColumn('amount', 'integer')
            ->addColumn('provider', 'string')
            ->addColumn('status', 'string')
            ->addColumn('createdAt', 'timestamp')
            ->create();

        $table->addForeignKey('orderId', 'order', ['id'])->save();
    }
}
