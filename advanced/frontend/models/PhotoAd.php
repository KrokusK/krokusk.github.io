<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 */
class PhotoAd extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $image_src_filename;
    public $image_web_filename;
    public $arrayWebFilename;
    public $msg;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%photo_ad}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ad_id', 'photo_path'], 'required'],
            [['photo_path'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 3,'mimeTypes' => ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'], 'extensions' => ['gif', 'jpg', 'jpeg', 'png'], 'maxSize' => 5*1024*1024, 'message' => 'Файл не соответствует требованиям'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->arrayWebFilename = [];

            foreach ($this->imageFiles as $image) {
                if (!empty($image) && $image->size !== 0) {
                    $this->image_src_filename = $image->name;
                    $tmp = explode(".", $image->name);
                    $ext = end($tmp);
                    // generate a unique file name to prevent duplicate filenames
                    $this->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                    array_push($arrayWebFilename, "{$this->image_web_filename}");
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/UserDesc/';
                    $path = Yii::$app->params['uploadPath'] . $this->image_web_filename;
                    $image->saveAs($path);
                } else {
                    $this->msg = 'problem1';
                    return false;
                }
            }
            return true;
        } else {
            $this->msg = 'problem2';
            return false;
        }
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
