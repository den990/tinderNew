<?php

use yii\db\Migration;

/**
 * Class m231220_164756_refactor_match
 */
class m231220_164756_refactor_match extends Migration
{

    public function up()
    {
        $this->dropForeignKey('fk-match-status', '{{%match}}');
        $this->dropForeignKey(
            'fk-first-match-id_user-user',
            '{{%match}}');
        $this->dropColumn('{{%match}}', 'state');
        $this->dropColumn('{{%match}}', 'first');
        $this->addColumn('{{%match}}', 'state_1', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%match}}', 'state_2', $this->integer()->unsigned()->notNull());
        $this->addForeignKey(
            'fk-match-status_1',
            '{{%match}}',
            'state_1',
            '{{%status}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-match-status_2',
            '{{%match}}',
            'state_2',
            '{{%status}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->addColumn('{{%match}}', 'state', $this->integer()->unsigned()->notNull());
        $this->addForeignKey(
            'fk-match-status',
            '{{%match}}',
            'state',
            '{{%status}}',
            'id',
            'CASCADE'
        );

        $this->dropForeignKey('fk-match-status_1', '{{%match}}');
        $this->dropForeignKey('fk-match-status_2', '{{%match}}');
        $this->dropColumn('{{%match}}', 'state_1');
        $this->dropColumn('{{%match}}', 'state_2');

        $this->addColumn('{{%match}}', 'first', $this->integer());
        $this->addForeignKey(
            'fk-first-match-id_user-user',
            '{{%match}}',
            'first',
            '{{%user}}',
            'id_user'
        );
    }
}
