<?php
declare(strict_types=1);

namespace Base\Migrations\products;

use Phinx\Migration\AbstractMigration;

final class Categories extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('categories');
        $table->addColumn('name', 'string', ['null'=>false])
        ->create();


    }

    
}
