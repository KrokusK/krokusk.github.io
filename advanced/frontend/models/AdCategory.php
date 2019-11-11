<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 */
class AdCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ad_category}}';
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAd()
    {
        return $this->hasOne(UserAd::className(), ['category_id' => 'id']);
    }
}
