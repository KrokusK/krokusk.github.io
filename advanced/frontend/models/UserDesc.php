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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'city_id', 'about', 'phone'], 'required', 'message' => 'Поле должно быть заполнено'],
            [['name'], 'string', 'max' => 255, 'message' => 'Число знаков не должно превышать 255'],
            [['city_id'], 'default', 'value' => 1],
            [['city_id'], 'integer', 'message' => 'Город не выбран из списка'],
            [['about'], 'string', 'max' => 255, 'message' => 'Число знаков не должно превышать 255'],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Номер телефона должен быть введен в формате: +7 (999) 999-99-99'],
        ];
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
        return $this->hasMany(User_ad::className(), ['user_desc_id' => 'id']);
    }
}
