<?php


use Phinx\Migration\AbstractMigration;

class CreateCommentsTable extends AbstractMigration
{
    public function up()
    {
        $this->table('comments')
                ->addColumn('status', 'integer', ['default'=>1])
                ->addColumn('user_id', 'integer')
                ->addColumn('page_id', 'integer')
                ->addColumn('comments', 'string', ['length'=>512, 'null'=>true])
                ->addForeignKey(['user_id'], 'users')
                ->addForeignKey(['page_id'], 'pages')
                ->addTimestamps()
                ->save();
    }
    
    
    public function down() {
        $this->dropTable('comments');
    }
}
