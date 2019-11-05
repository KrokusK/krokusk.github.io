<?php

use yii\db\Migration;

/**
 * Class m191105_044753_create_bulletin_board_tables
 */
class m191105_044753_create_bulletin_board_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191105_044753_create_bulletin_board_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191105_044753_create_bulletin_board_tables cannot be reverted.\n";

        return false;
    }
    */
}
