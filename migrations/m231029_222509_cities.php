<?php

use app\models\enums\Cities;
use yii\db\Migration;

/**
 * Class m231029_222509_cities
 */
class m231029_222509_cities extends Migration
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
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $cities = array_map(
            function ($name) {
                return [$name];
            },
            array_keys(Cities::listData())
        );

        $this->batchInsert('{{%city}}', ['name'], $cities);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->delete('{{%city}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231029_222509_cities cannot be reverted.\n";

        return false;
    }
    */
}
