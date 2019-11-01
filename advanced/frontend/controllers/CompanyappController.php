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
//use frontend\models\EntryForm;

/**
 * Company Application Form controller
 */
class CompanyappController extends Controller
{
    /**
     * Add company applioation
     */

    public function actionAddapp()
    {
        return $this->render('app-index');
    }

    public function actionAddcompanyprofile()
    {
        return $this->render('app-addprofile');
    }

}
