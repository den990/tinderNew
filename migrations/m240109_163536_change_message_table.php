<?php

use yii\db\Migration;

/**
 * Class m240109_163536_change_message_table
 */
class m240109_163536_change_message_table extends Migration
{
    public function up()
    {
        // Изменение типа столбца date на dateTime
        $this->alterColumn('{{%message}}', 'date', $this->dateTime()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Вернуть предыдущий тип столбца date (если необходимо)
        $this->alterColumn('{{%message}}', 'date', $this->date()->notNull());
    }
}
