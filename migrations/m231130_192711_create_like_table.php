<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m231130_192711_create_like_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%like}}', [
            'id_like' => $this->primaryKey(),
            'id_user_1' => $this->integer(),
            'id_user_2' => $this->integer(),
            'date' => $this->date()->notNull(),
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-user_id_1-like-id_user-user',
            '{{%like}}',
            'id_user_1',
            '{{%user}}',
            'id_user'
        );
        $this->addForeignKey(
            'fk-user_id_2-like-id_user-user',
            '{{%like}}',
            'id_user_2',
            '{{%user}}',
            'id_user'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_id_1-like-id_user-user', '{{%like}}');
        $this->dropForeignKey('fk-user_id_2-like-id_user-user', '{{%like}}');
        $this->dropTable('{{%like}}');
    }
}
