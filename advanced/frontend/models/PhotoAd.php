<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class PhotoAd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%photo_ad}}';
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAd()
    {
        return $this->hasOne(UserAd::className(), ['photo_id' => 'id']);
    }
}
