<?php
declare(strict_types=1);

namespace Base\Migrations\products;

use Phinx\Migration\AbstractMigration;

final class Colors extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('colors');
        $table->addColumn('productId', 'integer')
            ->addColumn('color', 'string', ['null'=> true])
            ->create();
    
        $table->addForeignKey('productId', 'products', ['id'])->save();
    }
}
