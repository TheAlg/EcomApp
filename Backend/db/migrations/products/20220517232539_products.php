<?php
declare(strict_types=1);

namespace Base\Migrations\Products;

use Phinx\Migration\AbstractMigration;

final class Products extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('products');
        $table->addColumn('title', 'string', ['limit' => 60, ])
            ->addColumn('subtitle', 'string', ['limit' => 120, 'null'=> true] )
            ->addColumn('description', 'string', ['limit' => 255,'null'=> true])
            ->addColumn('categoryId', 'integer', ['limit'=> 20])
            ->addColumn('picturePath', 'string', ['limit'=> 255, 'null' => true])
            ->addColumn('new', 'char', ['limit' => 1, 'default' => 'N'])
            ->addColumn('sale', 'char', ['limit' => 1, 'default' => 'N'])
            ->addColumn('top', 'char', ['limit' => 1, 'default' => 'N'])
            ->create();
    
        $table->addForeignKey('categoryId', 'categories', ['id'])->save();
    }
}
