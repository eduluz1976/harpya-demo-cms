<?php


use Phinx\Migration\AbstractMigration;

class CreatePagesTable extends AbstractMigration
{
   public function up()
    {
        $this->table('pages')
                ->addColumn('status', 'integer', ['default'=>1])
                ->addColumn('user_id', 'integer')
                ->addColumn('slug', 'string', ['length'=>100])
                ->addColumn('title', 'string', ['length'=>100])
                ->addColumn('summary', 'string', ['length'=>512, 'null'=>true])
                ->addColumn('contents', 'text', ['null'=>true])
                ->addIndex(['slug'], ['unique'=>true])  
                ->addForeignKey(['user_id'], 'users',['id'])
                ->addTimestamps()
                ->save();
    }
    
    
    public function down() {
        $this->dropTable('pages');
    }
}
