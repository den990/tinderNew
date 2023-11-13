<?php

use yii\db\Migration;

/**
 * Class m231030_133027_create_photo_in_user
 */
class m231030_133027_create_photo_in_user extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%user}}', 'photo', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'photo');
    }
}
