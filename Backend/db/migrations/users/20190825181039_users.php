<?php
declare(strict_types=1);

namespace Base\Migrations\Users;

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function change(){

        $table = $this->table('users');
        if ($table->exists()) {
            return;
        }
        $table = $this->table('users');
        $table->addColumn('firstName', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('lastName', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('userName', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('birthday', 'timestamp', ['null'=> true])
            ->addColumn('isoCode', 'char', ['limit' => 7, 'null'=> true])
            ->addColumn('phoneNumber', 'string', ['limit' => 100, 'null'=> true])
            ->addColumn('password', 'char', ['limit' => 100])
            ->addColumn('mustChangePassword', 'char', ['limit' => 1])
            ->addColumn('profilesId', 'integer')
            ->addColumn('banned', 'char', ['limit' => 1])
            ->addColumn('suspended', 'char', ['limit' => 1, 'default' => 'N'])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updatedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['profilesId'])
            ->create();
        $table->addForeignKey('profilesId', 'profiles', ['id'])->save();
            
    }
    
}
