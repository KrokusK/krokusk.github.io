<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class UserCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_city}}';
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAd()
    {
        return $this->hasOne(UserAd::className(), ['city_id' => 'id']);
    }

    /**
     *
     * Link to table User_description
     */
    public function getUserDesc()
    {
        return $this->hasOne(User_description::className(), ['city_id' => 'id']);
    }
}
