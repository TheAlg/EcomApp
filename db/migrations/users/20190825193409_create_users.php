<?php
declare(strict_types=1);

namespace Base\Migrations\users;

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change(){

        $table = $this->table('users');
        if ($table->exists()) {
            return;
        }
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('lastName', 'string', ['null'=> true, 'limit' => 255])
            ->addColumn('birthdate', 'date', ['null'=> true])
            ->addColumn('phoneNumber', 'string', ['null'=> true])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'char', ['limit' => 60])
            ->addColumn('mustChangePassword', 'char', ['limit' => 1])
            ->addColumn('profilesId', 'integer')
            ->addColumn('banned', 'char', ['limit' => 1])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updatedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('suspended', 'char', ['limit' => 1, 'default' => 'N'])
            ->addColumn('suspendedd', 'char', ['limit' => 1, 'default' => 'N'])

            ->addColumn('active', 'char', ['limit' => 1, 'default' => null, 'null' => true])
            ->addIndex(['profilesId'])
            ->create();
            
        $table->addForeignKey('profilesId', 'profiles', ['id'])->save();
            
    }
    
}
