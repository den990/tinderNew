<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m231207_181443_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%message}}', [
            'id_message' => $this->primaryKey(),
            'id_chat' => $this->integer(),
            'id_user' => $this->integer(),
            'text' => $this->string()->notNull(),
            'date' => $this->date()->notNull(),
            'isRead' => $this->boolean()->notNull()
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-user_id-message-id_user-user',
            '{{%message}}',
            'id_user',
            '{{%user}}',
            'id_user'
        );
        $this->addForeignKey(
            'fk-id_chat-chat-id_user-user',
            '{{%message}}',
            'id_chat',
            '{{%chat}}',
            'id_chat'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_id-message-id_user-user', '{{%message}}');
        $this->dropForeignKey('fk-id_chat-chat-id_user-user', '{{%message}}');
        $this->dropTable('{{%message}}');
    }
}
