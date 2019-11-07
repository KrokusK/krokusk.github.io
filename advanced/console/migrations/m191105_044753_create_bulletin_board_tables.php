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
        // create User descriiption table
        $this->createTable('{{%user_description}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'city_id' => $this->integer()->notNull(),
            'about' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'ad_id' => $this->integer()->notNull(),
        ]);

        // creates index for column user_id`
        $this->createIndex(
            'idx-user-description-user-id',
            '{{%user_description}}',
            'user_id'
        );

        // creates index for column city_id`
        $this->createIndex(
            'idx-user-description-city-id',
            '{{%user_description}}',
            'city_id'
        );

        // creates index for column ad_id`
        $this->createIndex(
            'idx-user-description-ad-id',
            '{{%user_description}}',
            'ad_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-description-user-id',
            '{{%user_description}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%user_city}}', [
            'id' => $this->primaryKey(),
            'city_name' => $this->string()->notNull(),
        ]);

        // add foreign key for table `user_city`
        $this->addForeignKey(
            'fk-user-description-city-id',
            '{{%user_description}}',
            'city_id',
            '{{%user_city}}',
            'id',
            'CASCADE'
        );

        // create User ad table
        $this->createTable('{{%user_ad}}', [
            'id' => $this->primaryKey(),
            'status_id' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'header' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'amount' => $this->float()->notNull(),
            'category_id' => $this->smallInteger()->notNull(),
            'photo_id' => $this->integer()->notNull(),
        ]);

        // creates index for column status_id`
        $this->createIndex(
            'idx-user-ad-status-id',
            '{{%user_ad}}',
            'status_id'
        );

        // creates index for column city_id`
        $this->createIndex(
            'idx-user-ad-city-id',
            '{{%user_ad}}',
            'category_id'
        );

        // creates index for column category_id`
        $this->createIndex(
            'idx-user-ad-category-id',
            '{{%user_ad}}',
            'status_id'
        );

        // creates index for column photo_id`
        $this->createIndex(
            'idx-user-ad-photo-id',
            '{{%user_ad}}',
            'photo_id'
        );

        // add foreign key for table `user_ad`
        $this->addForeignKey(
            'fk-user-description-ad-id',
            '{{%user_description}}',
            'ad_id',
            '{{%user_ad}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user_city`
        $this->addForeignKey(
            'fk-user-ad-city-id',
            '{{%user_ad}}',
            'city_id',
            '{{%user_city}}',
            'id',
            'CASCADE'
        );

        // create ad_status table
        $this->createTable('{{%ad_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // add foreign key for table `ad_status`
        $this->addForeignKey(
            'fk-user-ad-status-id',
            '{{%user_ad}}',
            'status_id',
            '{{%ad_status}}',
            'id',
            'CASCADE'
        );

        // create ad_category table
        $this->createTable('{{%ad_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // add foreign key for table `ad_category`
        $this->addForeignKey(
            'fk-user-ad-category-id',
            '{{%user_ad}}',
            'category_id',
            '{{%ad_category}}',
            'id',
            'CASCADE'
        );

        // create Photo ad table
        $this->createTable('{{%photo_ad}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'photo_path' => $this->string()->notNull(),
        ]);

        // add foreign key for table `ad_photo`
        $this->addForeignKey(
            'fk-user-ad-photo-id',
            '{{%user_ad}}',
            'photo_id',
            '{{%photo_ad}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `ad_photo`
        $this->dropForeignKey(
            'fk-user-ad-photo-id',
            '{{%user_ad}}'
        );

        // drops table `Photo_ad`
        $this->dropTable('{{%photo_ad}}');

        // drops foreign key for table `ad_category`
        $this->dropForeignKey(
            'fk-user-ad-category-id',
            '{{%user_ad}}'
        );

        // drops table `ad_category`
        $this->dropTable('{{%ad_category}}');

        // drops foreign key for table `ad_status`
        $this->dropForeignKey(
            'fk-user-ad-status-id',
            '{{%user_ad}}'
        );

        // drops table `ad_status`
        $this->dropTable('{{%ad_status}}');

        // drops foreign key for table `user_city`
        $this->dropForeignKey(
            'fk-user-ad-city-id',
            '{{%user_ad}}'
        );

        // drops foreign key for table `user_ad`
        $this->dropForeignKey(
            'fk-user-description-ad-id',
            '{{%user_description}}'
        );

        // drops index for column `photo_id`
        $this->dropIndex(
            'idx-user-ad-photo-id',
            '{{%user_ad}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-user-ad-category-id',
            '{{%user_ad}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'idx-user-ad-city-id',
            '{{%user_ad}}'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            'idx-user-ad-status-id',
            '{{%user_ad}}'
        );

        // drops table `user_ad`
        $this->dropTable('{{%user_ad}}');

        // drops foreign key for table `user_city`
        $this->dropForeignKey(
            'fk-user-description-city-id',
            '{{%user_description}}'
        );

        // drops table `user_city`
        $this->dropTable('{{%user_city}}');

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user-description-user-id',
            '{{%user_description}}'
        );

        // drops index for column `ad_id`
        $this->dropIndex(
            'idx-user-description-ad-id',
            '{{%user_description}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'idx-user-description-city-id',
            '{{%user_description}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user-description-user-id',
            '{{%user_description}}'
        );

        // drops table `user_description`
        $this->dropTable('{{%user_description}}');
    }
}
