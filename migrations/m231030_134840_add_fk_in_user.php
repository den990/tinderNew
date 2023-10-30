<?php

use yii\db\Migration;

/**
 * Class m231030_134840_add_fk_in_user
 */
class m231030_134840_add_fk_in_user extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addForeignKey('fk-user-photo', '{{%user}}', 'photo', 'photo', 'id_photo');
    }

    public function down()
    {
        $this->dropForeignKey('fk-user-photo', '{{%user}}');
    }

}
