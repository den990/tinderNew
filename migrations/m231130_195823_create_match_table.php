<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%match}}`.
 */
class m231130_195823_create_match_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%match}}', [
            'id_match' => $this->primaryKey(),
            'id_user_1' => $this->integer(),
            'id_user_2' => $this->integer(),
            'state' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-user_id_1-match-id_user-user',
            '{{%match}}',
            'id_user_1',
            '{{%user}}',
            'id_user'
        );
        $this->addForeignKey(
            'fk-user_id_2-match-id_user-user',
            '{{%match}}',
            'id_user_2',
            '{{%user}}',
            'id_user'
        );
        $this->addForeignKey(
            'fk-match-status',
            '{{%match}}',
            'state',
            '{{%status}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_id_1-match-id_user-user', '{{%match}}');
        $this->dropForeignKey('fk-user_id_2-match-id_user-user', '{{%match}}');
        $this->dropForeignKey('fk-match-status', '{{%match}}');
        $this->dropTable('{{%match}}');
    }
}
