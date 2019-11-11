<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class UserAd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_ad}}';
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserDescs()
    {
        return $this->hasOne(User_description::className(), ['ad_id' => 'id']);
    }

    /**
     *
     * Link to table Ad_status
     */
    public function getAdStatus()
    {
        return $this->hasOne(Ad_status::className(), ['id' => 'status_id']);
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
     * Link to table Ad_category
     */
    public function getAdCaterories()
    {
        return $this->hasOne(Ad_category::className(), ['id' => 'category_id']);
    }

    /**
     *
     * Link to table Photo_ad
     */
    public function getAdPhotos()
    {
        return $this->hasMany(PhotoAd::className(), ['id' => 'photo_id']);
    }
}
