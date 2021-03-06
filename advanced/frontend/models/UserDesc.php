<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 */
class UserDesc extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $image_src_filename;
    public $image_web_filename;
    public $msg;

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
            //[['city_id'], 'default', 'value' => '1'],
            //[['city_id'], 'integer', 'message' => 'Город не выбран из списка'],
            //[['city_id'], 'in', 'range' => ['1','2'], 'message' => 'Город не выбран из списка'],
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
            [['about'], 'string', 'max' => 255, 'message' => 'Число знаков не должно превышать 255'],
            [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Номер телефона должен быть введен в формате: +7 (999) 999-99-99'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'mimeTypes' => ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'], 'extensions' => ['gif', 'jpg', 'jpeg', 'png'], 'maxSize' => 5*1024*1024, 'message' => 'Файл не соответствует требованиям'],
        ];
    }

    /**
     * upload ad avatar to the server
     */
    public function upload()
    {
        // get avatar image and save to the server as random filename
        $image = $this->imageFile;
        if (!empty($image) && $image->size !== 0) {
            // save avatar
            $this->image_src_filename = $image->name;
            $tmp = explode(".", $image->name);
            $ext = end($tmp);
            // generate a unique file name to prevent duplicate filenames
            $this->image_web_filename = Yii::$app->security->generateRandomString() . ".{$ext}";
            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/UserDesc/';
            $path = Yii::$app->params['uploadPath'] . $this->image_web_filename;
            $image->saveAs($path);
            return true;
        } else {
            $this->msg = 'problem1';
            return false;
        }
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
        return $this->hasOne(UserCity::className(), ['id' => 'city_id']);
    }

    /**
     *
     * Link to table User_ad
     */
    public function getUserAds()
    {
        return $this->hasMany(UserAd::className(), ['user_desc_id' => 'id']);
    }
}
