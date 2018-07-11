<?php


use Phinx\Migration\AbstractMigration;

class CreateTableUserPermissions extends AbstractMigration
{
 
    public function up()
    {
        $this->table('user_permission',['id'=>false,'pk'=>['user_id','permission']])
                ->addColumn('user_id', 'integer')
                ->addColumn('permission', 'string', ['length'=>40])
                ->addColumn('status', 'integer',['default'=>1])
                ->addTimestamps()
                ->save();
    }
    
    public function down() {
        $this->dropTable('user_permission');
    }
    
}
