<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class UserDesc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_description}}';
    }

    /**
     *
     * Link to table User
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     *
     * Link to table User_city
     */
    public function getUserCities()
    {
        return $this->hasOne(User_city::className(), ['id' => 'city_id']);
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAds()
    {
        return $this->hasOne(User_ad::className(), ['id' => 'ad_id']);
    }
}
