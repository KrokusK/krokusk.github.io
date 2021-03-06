<?php
namespace frontend\controllers;

//use frontend\models\ResendVerificationEmailForm;
//use frontend\models\VerifyEmailForm;
use Yii;
//use yii\base\InvalidArgumentException;
//use yii\web\BadRequestHttpException;
use yii\web\Controller;
//use yii\web\Request;
//use yii\filters\VerbFilter;
//use yii\filters\AccessControl;
//use common\models\LoginForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use frontend\models\SignupForm;
//use frontend\models\ContactForm;
use frontend\models\EntryForm;

/**
 * Site controller
 */
class RandomController extends Controller
{
    /**
     * output message
     */

    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }

    /**
     * output message
     */

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm-post', ['model' => $model]);
        }
        elseif ($model->load(Yii::$app->request->get()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm-get', ['model' => $model]);
        }else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionView()
    {
//        return $this->render('random-view');

        $model = new EntryForm();

        if ($model->load(Yii::$app->request->get()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('random-view', ['model' => $model]);
        }else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionCreate()
    {
//        return $this->render('random-create');

        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('random-create', ['model' => $model]);
        }else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }

    }

    public function actionDelete()
    {
        //return $this->render('random-delete');

        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('random-delete', ['model' => $model]);
        }else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }
}
