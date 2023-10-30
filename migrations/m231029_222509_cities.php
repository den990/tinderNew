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
        $this->batchInsert('{{%city}}', ['name'], array_map(
            function ($name) {
                return [$name];
            },
            array_values(Cities::listData())
        ));
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
