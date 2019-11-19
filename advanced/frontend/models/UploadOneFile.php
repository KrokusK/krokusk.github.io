<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadOneFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'mimeTypes' => ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'], 'extensions' => ['gif', 'jpg', 'jpeg', 'png'], 'maxSize' => 5*1024*1024],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
