<?php


use Phinx\Migration\AbstractMigration;

class CreateTokensTable extends AbstractMigration
{
    
    public function change()
    {
        $this->table('tokens')
                ->addColumn('user_id', 'integer')
                ->addColumn('status', 'integer', ['default'=>1])
                ->addColumn('hash', 'string', ['length'=>100, 'null'=>false])
                ->addColumn('controller', 'string', ['length'=>100, 'null'=>false])
                ->addColumn('method', 'string', ['length'=>100, 'null'=>false])
                ->addColumn('parms', 'string', ['length'=>500, 'null'=>false])
                ->addTimestamps()
                ->save();
    }
}
