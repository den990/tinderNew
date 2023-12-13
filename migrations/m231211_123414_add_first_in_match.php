<?php

use yii\db\Migration;

/**
 * Class m231211_123414_add_first_in_match
 */
class m231211_123414_add_first_in_match extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%match}}', 'first', $this->integer());
        $this->addForeignKey(
            'fk-first-match-id_user-user',
            '{{%match}}',
            'first',
            '{{%user}}',
            'id_user'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-first-match-id_user-user', '{{%match}}');
        $this->dropColumn('{{%match}}', 'first');
        $this->delete('{{%match}}');
    }

}
