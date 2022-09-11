<?php
declare(strict_types=1);

namespace Base\Migrations\products;

use Phinx\Migration\AbstractMigration;

final class ProductPricing extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('productPricing');
        $table->addColumn('productId', 'integer', ['null'=>false])
            ->addColumn('basePrice', 'double',['null'=>false])
            ->addColumn('create_date', 'datetime', ['default' => date('Y-m-d H:i:s')])
            ->addColumn('expiry_date', 'datetime', ['default'=> '2050-01-01 00:00:00'])
            ->addColumn('inActive', 'char',['limit'=>1,'default'=>'Y'])
            ->create();
    
        $table->addForeignKey('productId', 'products', ['id'])->save();
    }
}
