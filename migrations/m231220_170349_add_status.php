<?php

use yii\db\Migration;

/**
 * Class m231220_170349_add_status
 */
class m231220_170349_add_status extends Migration
{

    public function up()
    {
        $this->insert('{{%status}}', ['id' => 4, 'status' => 'Undefined']);

    }

    public function down()
    {
        $this->delete('{{%status}}', ['id' => 4, 'status' => 'Undefined']);
    }
}
