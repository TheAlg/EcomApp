<?php
declare(strict_types=1);

namespace Base\Migrations\Order;

use Phinx\Migration\AbstractMigration;

final class OrderItems extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('order_items');
        $table->addColumn('orderId', 'integer')
            ->addColumn('productId', 'integer')
            ->addColumn('productQty', 'integer')
            ->addColumn('createdAt', 'timestamp')
            ->create();

        $table->addForeignKey('productId', 'products', ['id'])->save();
        $table->addForeignKey('orderId', 'order', ['id'])->save();

    }
}
