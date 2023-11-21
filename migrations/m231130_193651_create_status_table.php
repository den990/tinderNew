<?php

use yii\db\Migration;
use app\models\enums\Status;
/**
 * Handles the creation of table `{{%status}}`.
 */
class m231130_193651_create_status_table extends Migration
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
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey()->unsigned(),
            'status' => $this->string()->notNull(),
        ], $tableOptions);

        $status = array_map(
            function ($name) {
                return [$name];
            },
            array_keys(Status::$state)
        );

        $this->batchInsert('{{%status}}', ['status'], $status);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%status}}');
    }
}
