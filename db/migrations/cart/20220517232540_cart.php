<?php
declare(strict_types=1);

namespace Base\Migrations\Cart;

use Phinx\Migration\AbstractMigration;

final class Cart extends AbstractMigration
{
    public function change(){

        $table = $this->table('cart');
        $table->addColumn('productId', 'integer')
            ->addColumn('productQty', 'integer')
            ->addColumn('userId', 'integer')
            ->addColumn('totalPrice', 'integer')
            ->create();
    
        $table->addForeignKey('productId', 'products', ['id'])->save();
        $table->addForeignKey('userId', 'users', ['id'])->save();
    }
}
