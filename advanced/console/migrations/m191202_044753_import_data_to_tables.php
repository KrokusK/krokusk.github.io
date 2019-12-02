<?php

use yii\db\Migration;
//use yii\db\Command;

/**
 * Class m191202_044753_import_data_to_tables
 */
class m191202_044753_import_data_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // erase table records and sequences before to insert
        //$this->db->createCommand()->delete($table->user)->execute();
        //if ($table->sequenceName !== null) {
        //    $this->db->createCommand()->resetSequence($table->user, 1)->execute();
        //}
        /*$this->delete('user');
        $this->resetSequence('user');*/
        $this->delete('user_city');
        $this->executeResetSequence('user_city');


        // import to the user table
        /*$this->insert('user', [
            'username' => 'user1',
            'auth_key' => 'NEzqJuqXo8wioifO2fvqlJx5USw00JJX',
            'password_hash' => '$2y$13$spHblbtmjJ3z9m1bMG37sOL32o9JHACU/zMAGYBjz2Z2DT47jd/u2', //password 123456
            'password_reset_token' => null,
            'email' => 'user1@test.test',
            'status' => 10,
            'created_at' => 1573193110,
            'updated_at' => 1573193110,
            'verification_token' => 'qrc1yffNDZ8y4mhwhxYDfn7seOLDZumT_1573193110'
        ]);

        $this->insert('user', [
            'username' => 'user2',
            'auth_key' => 'GrPhvOC9giYGShYQxw_qjPBTtoXlrblI',
            'password_hash' => '$2y$13$bhWAaZFgXYvlvNio51hwx.7FyrefJZpn3AL.oB.0OGCW8.Up22jze', //password 123456
            'password_reset_token' => null,
            'email' => 'user2@test.test',
            'status' => 10,
            'created_at' => 1573193147,
            'updated_at' => 1573193147,
            'verification_token' => 'mkmthVMPWftYDhW_fiyWKLQ681CJMbZy_1573193147'
        ]);*/

        $this->insert('user_city', [
            'city_name' => 'Томск'
        ]);
        $this->insert('user_city', [
            'city_name' => 'Северск'
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // erase table records and sequences
        /*$this->delete('user');
        $this->resetSequence('user');*/

        $this->delete('user_city');
        $this->resetSequence('user_city');
    }
}
