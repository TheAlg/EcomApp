<?php
declare(strict_types=1);

namespace Base\Migrations\Products;

use Phinx\Migration\AbstractMigration;

final class Sizes extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('sizes');
        $table->addColumn('productId', 'integer')
            ->addColumn('size', 'enum', ['values' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']] )
            ->create();
    
        $table->addForeignKey('productId', 'products', ['id'])->save();

    }
}
