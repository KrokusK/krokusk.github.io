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
class CompanyAppController extends Controller
{
    /**
     * output message
     */

    public function actionAddCompany()
    {
        return $this->render('company-index');
    }
}
