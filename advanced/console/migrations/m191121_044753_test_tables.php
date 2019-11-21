<?php

use yii\db\Migration;

/**
 * Class m191112_044753_create_bulletin_board_tables
 */
class m191121_044753_test_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // create test table
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops table
        $this->dropTable('{{%test}}');
    }
}
