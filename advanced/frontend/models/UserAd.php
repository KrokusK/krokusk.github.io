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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_desc_id', 'status_id', 'header', 'content', 'city_id', 'amount', 'category_id'], 'required', 'message' => 'Поле должно быть заполнено'],
            [['status_id'], 'in', 'range' =>
                function ( $attribute, $params ) {
                    $statusesId = AdStatus::find()->select(['id'])->asArray()->all();
                    $statusesIdStr = [];
                    foreach ($statusesId as $item) {
                        array_push($statusesIdStr, "{$item['id']}");
                    }
                    return $statusesIdStr;
                },
                'message' => 'Статус не выбран из списка'],
            [['header'], 'string', 'max' => 255, 'message' => 'Число знаков не должно превышать 255'],
            [['content'], 'string', 'max' => 255, 'message' => 'Число знаков не должно превышать 255'],
            [['city_id'], 'in', 'range' =>
                function ( $attribute, $params ) {
                    $citiesId = UserCity::find()->select(['id'])->asArray()->all();
                    $citiesIdStr = [];
                    foreach ($citiesId as $item) {
                        array_push($citiesIdStr, "{$item['id']}");
                    }
                    return $citiesIdStr;
                },
                'message' => 'Город не выбран из списка'],
            [['amount'], 'double', 'message' => 'Значение должно быить числом'],
            [['category_id'], 'in', 'range' =>
                function ( $attribute, $params ) {
                    $categoriesId = AdCategory::find()->select(['id'])->asArray()->all();
                    $categoriesIdStr = [];
                    foreach ($categoriesId as $item) {
                        array_push($categoriesIdStr, "{$item['id']}");
                    }
                    return $categoriesIdStr;
                },
                'message' => 'Категория не выбрана из списка'],
        ];
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
