<?php

use yii\db\Migration;

/**
 * Class m191029_065448_create_application_company_tables
 */
class m191029_065448_create_application_company_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_description}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'company_address' => $this->string()->notNull(),
            'company_site' => $this->string()->notNull(),
            'count_projects' => $this->integer()->notNull(),
            'company_staff' => $this->string()->notNull(),
            'company_phone' => $this->integer(10)->notNull(),
            'company_experience' => $this->string()->notNull(),
            'cost_hour' => $this->float()->notNull(),
            'company_competence' => $this->string()->notNull(),
            'application_id' => $this->integer()->notNull(),
        ]);

        // creates index for column company_city_id`
        $this->createIndex(
            'idx-company-description-city-id',
            '{{%company_description}}',
            'city_id'
        );

        // creates index for column application_id`
        $this->createIndex(
            'idx-company-description-application-id',
            '{{%company_description}}',
            'application_id'
        );

        $this->createTable('{{%company_city}}', [
            'id' => $this->primaryKey(),
            'city_name' => $this->string()->notNull(),
        ]);

        // add foreign key for table `company_city`
        $this->addForeignKey(
            'fk-company-description-city-id',
            '{{%company_description}}',
            'city_id',
            '{{%company_city}}',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%company_application}}', [
            'id' => $this->primaryKey(),
            'project_name' => $this->string()->notNull(),
            'project_cost' => $this->float()->notNull(),
            'project_desc' => $this->string()->notNull(),
            'contact_manager' => $this->string()->notNull(),
        ]);

        // add foreign key for table `company_application`
        $this->addForeignKey(
            'fk-company-description-application-id',
            '{{%company_description}}',
            'application_id',
            '{{%company_application}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `company_description`
        $this->dropForeignKey(
            'fk-company-description-city-id',
            '{{%company_description}}'
        );

        // drops foreign key for table `company_description`
        $this->dropForeignKey(
            'fk-company-description-application-id',
            '{{%company_description}}'
        );

        // drops index for column `city-id`
        $this->dropIndex(
            'idx-company-description-city-id',
            '{{%company_description}}'
        );

        // drops index for column `application-id`
        $this->dropIndex(
            'idx-company-description-application-id',
            '{{%company_description}}'
        );

        $this->dropTable('{{%company_description}}');
        $this->dropTable('{{%company_city}}');
        $this->dropTable('{{%company_application}}');
    }
}

