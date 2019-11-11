<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class AdStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ad_status}}';
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAd()
    {
        return $this->hasOne(UserAd::className(), ['status_id' => 'id']);
    }
}
