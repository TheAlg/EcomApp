<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

final class Profiles extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('profiles');
        $table->addColumn('name', 'string', ['limit' => 64])
            ->create();
            
    }
}
