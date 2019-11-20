<?php
namespace frontend\models;

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
     * Link to table User_description
     */
    public function getUserDescs()
    {
        return $this->hasOne(UserDesc::className(), ['id' => 'user_desc_id']);
    }

    /**
     *
     * Link to table Ad_status
     */
    public function getAdStatus()
    {
        return $this->hasOne(AdStatus::className(), ['id' => 'status_id']);
    }

    /**
     *
     * Link to table User_city
     */
    public function getUserCities()
    {
        return $this->hasOne(UserCity::className(), ['id' => 'city_id']);
    }

    /**
     *
     * Link to table Ad_category
     */
    public function getAdCategories()
    {
        return $this->hasOne(AdCategory::className(), ['id' => 'category_id']);
    }

    /**
     *
     * Link to table Photo_ad
     */
    public function getAdPhotos()
    {
        return $this->hasMany(PhotoAd::className(), ['ad_id' => 'id']);
    }
}
