<?php

use yii\db\Migration;

/**
 * Class m231029_223022_create_user
 */
class m231029_223022_create_user extends Migration
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

        $this->createTable('{{%user}}', [
            'id_user' => $this->primaryKey(),
            'first_name' => $this->string(32)->notNull(),
            'last_name' => $this->string(32)->notNull(),
            'gender' => $this->tinyInteger(1)->unsigned()->notNull(),
            'birthday' => $this->date()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'description' => $this->string(150),
            'location' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-user-location',
            '{{%user}}',
            'location',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-user-location', '{{%user}}');
        $this->dropTable('{{%user}}');
    }


}
