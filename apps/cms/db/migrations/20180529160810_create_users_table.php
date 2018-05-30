<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
  public function up()
    {
        $this->table('users')
                ->addColumn('status', 'integer', ['default'=>1])
                ->addColumn('email', 'string', ['length'=>200])
                ->addColumn('hash', 'string', ['length'=>200])                
                ->addIndex(['email'], ['unique'=>true])
                ->addTimestamps()
                ->save();
    }
    
    public function down() {
        $this->dropTable('users');
                
    }
}
