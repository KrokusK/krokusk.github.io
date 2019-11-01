<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Company_description".
 *
 * @property string $company_name
 * @property int $city_id
 * @property string $company_address
 */
class Companyapp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'city_id', 'company_address', 'company_site', 'count_projects', 'company_staff', 'company_phone', 'company_experience', 'cost_hour', 'company_competence', 'application_id'], 'required'],
            [['company_name'], 'string', 'max' => 255],
            [['city_id'], 'default', 'value' => 1],
            [['city_id'], 'integer'],
            [['company_address'], 'string', 'max' => 255],
            [['company_site'], 'string', 'max' => 255],
            [['count_projects'], 'integer'],
            [['company_staff'], 'string', 'max' => 255],
            [['company_phone'], 'integer', 'max' => 10],
            [['company_experience'], 'string', 'max' => 255],
            [['cost_hour'], 'double'],
            [['company_competence'], 'string', 'max' => 255],
            [['application_id'], 'default', 'value' => 1],
            [['application_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
 /*   public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'population' => 'Population',
        ];
    }
 */
}
