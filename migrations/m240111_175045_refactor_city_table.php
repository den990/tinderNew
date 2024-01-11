<?php

use app\models\enums\Cities;
use yii\db\Migration;

/**
 * Class m240111_175045_refactor_city_table
 */
class m240111_175045_refactor_city_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->execute('SET foreign_key_checks = 0');

        // Очищаем таблицу
        $this->truncateTable('{{%city}}');

        // Сбрасываем счетчик AUTO_INCREMENT (для MySQL)
        $this->execute('ALTER TABLE {{%city}} AUTO_INCREMENT = 0');

        $cities = array_map(
            function ($name) {
                return [$name];
            },
            array_keys(Cities::$codeToValue)
        );

        $this->batchInsert('{{%city}}', ['name'], $cities);

        $this->execute('SET foreign_key_checks = 1');
    }

    public function down()
    {

    }
}
