<?php

use yii\db\Migration;

/**
 * Class m240110_150200_add_preferences_table
 */
class m240110_150200_add_preferences_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%preferences}}', [
            'id_preferences' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'location' => $this->integer()->unsigned()->notNull(),
            'gender' => $this->tinyInteger(1)->unsigned()->notNull(),
            'age_start' => $this->integer()->unsigned()->notNull(),
            'age_end' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        // Добавьте внешний ключ
        $this->addForeignKey(
            'fk-preferences-location',
            '{{%preferences}}',
            'location',
            '{{%city}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-id_user-preferences-id_user-user',
            '{{%preferences}}',
            'id_user',
            '{{%user}}',
            'id_user'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-preferences-location', '{{%preferences}}');
        $this->dropForeignKey('fk-id_user-preferences-id_user-user', '{{%preferences}}');
        $this->dropTable('{{%preferences}}');
    }
}
