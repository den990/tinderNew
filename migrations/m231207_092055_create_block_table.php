<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%block}}`.
 */
class m231207_092055_create_block_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block}}', [
            'id_block' => $this->primaryKey(),
            'id_user_blocker' => $this->integer(),
            'id_user_blocked' => $this->integer(),
            'date' => $this->date()->notNull(),
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-user_id_blocker-block-id_user-user',
            '{{%block}}',
            'id_user_blocker',
            '{{%user}}',
            'id_user'
        );
        $this->addForeignKey(
            'fk-user_id_blocked-block-id_user-user',
            '{{%block}}',
            'id_user_blocked',
            '{{%user}}',
            'id_user'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_id_blocker-block-id_user-user', '{{%block}}');
        $this->dropForeignKey('fk-user_id_blocked-block-id_user-user', '{{%block}}');
        $this->dropTable('{{%block}}');
    }
}
