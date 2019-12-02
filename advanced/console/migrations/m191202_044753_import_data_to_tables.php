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
        $this->delete('photo_ad');
        $this->delete('user_ad');
        $this->delete('user_description');
        $this->delete('ad_category');
        $this->delete('ad_status');
        $this->delete('user_city');
        $this->delete('user');

        $this->db->createCommand()->resetSequence('photo_ad', 1)->execute();
        $this->db->createCommand()->resetSequence('user_ad', 1)->execute();
        $this->db->createCommand()->resetSequence('user_description', 1)->execute();
        $this->db->createCommand()->resetSequence('ad_category', 1)->execute();
        $this->db->createCommand()->resetSequence('ad_status', 1)->execute();
        $this->db->createCommand()->resetSequence('user_city', 1)->execute();
        $this->db->createCommand()->resetSequence('user', 1)->execute();


        // import to the user table
        $this->insert('user', [
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
        ]);


        // import to the user_city table
        $this->insert('user_city', [
            'city_name' => 'Томск'
        ]);
        $this->insert('user_city', [
            'city_name' => 'Северск'
        ]);


        // import to the ad_status table
        $this->insert('ad_status', [
            'name' => 'Закрытое'
        ]);
        $this->insert('ad_status', [
            'name' => 'Активное'
        ]);


        // import to the ad_category table
        $this->insert('ad_category', [
            'name' => 'Квартиры'
        ]);
        $this->insert('ad_category', [
            'name' => 'Машины'
        ]);


        // import to the user_description table
        $this->insert('user_description', [
            'user_id' => 1,
            'name' => 'superuser1',
            'avatar' => 'https://drive.google.com/open?id=16wt5baM0dXRm8u-mGOU_ZIcKSOcdwarM',
            'city_id' => 1,
            'about' => 'About1',
            'phone' => '+7 (999) 999-99-99'
        ]);

        $this->insert('user_description', [
            'user_id' => 2,
            'name' => 'superuser2',
            'avatar' => 'https://drive.google.com/open?id=16wt5baM0dXRm8u-mGOU_ZIcKSOcdwarM',
            'city_id' => 2,
            'about' => 'About2',
            'phone' => '+7 (999) 999-99-99'
        ]);


        // import to the user_ad table
        $this->insert('user_ad', [
            'user_desc_id' => 1,
            'status_id' => 2,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'header' => 'Header1',
            'content' => 'Content1',
            'city_id' => 1,
            'amount' => 1500,
            'category_id' => 1
        ]);

        $this->insert('user_ad', [
            'user_desc_id' => 2,
            'status_id' => 2,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'header' => 'Header2',
            'content' => 'Content2',
            'city_id' => 2,
            'amount' => 2000,
            'category_id' => 2
        ]);

        // import to the photo_ad table
        $this->insert('user_ad', [
            'ad_id' => 1,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'photo_path' => 'https://drive.google.com/open?id=1iV6Pw4y-lpA1MNyxjdEQfpG_vYaA15-T'
        ]);

        $this->insert('user_ad', [
            'ad_id' => 1,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'photo_path' => 'https://drive.google.com/open?id=1wsj-0bFOb2gqJuqn8NM1BjXXMN0cTnkC'
        ]);

        $this->insert('user_ad', [
            'ad_id' => 1,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'photo_path' => 'https://drive.google.com/open?id=1lyPBJyRiLlYOUNm_YmG99c6fAagsEiny'
        ]);

        $this->insert('user_ad', [
            'ad_id' => 2,
            'created_at' => 1523459999,
            'updated_at' => 1523459999,
            'photo_path' => 'https://drive.google.com/open?id=1lyPBJyRiLlYOUNm_YmG99c6fAagsEiny'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // erase table records and sequences
        $this->delete('photo_ad');
        $this->delete('user_ad');
        $this->delete('user_description');
        $this->delete('ad_category');
        $this->delete('ad_status');
        $this->delete('user_city');
        $this->delete('user');

        $this->db->createCommand()->resetSequence('photo_ad', 1)->execute();
        $this->db->createCommand()->resetSequence('user_ad', 1)->execute();
        $this->db->createCommand()->resetSequence('user_description', 1)->execute();
        $this->db->createCommand()->resetSequence('ad_category', 1)->execute();
        $this->db->createCommand()->resetSequence('ad_status', 1)->execute();
        $this->db->createCommand()->resetSequence('user_city', 1)->execute();
        $this->db->createCommand()->resetSequence('user', 1)->execute();
    }
}
