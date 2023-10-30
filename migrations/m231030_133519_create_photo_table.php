<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photo}}`.
 */
class m231030_133519_create_photo_table extends Migration
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

        $this->createTable('{{%photo}}', [
            'id_photo' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'id_user' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk-photo-user_id', '{{%photo}}', 'id_user', '{{%user}}', 'id_user', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%photo}}');
    }
}
