<?php
namespace frontend\controllers;

//use frontend\models\ResendVerificationEmailForm;
//use frontend\models\VerifyEmailForm;
use app\models\Companyapp;
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
//use frontend\models\CompanyAppAdd;

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
        $model = new Companyapp();

/*
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($model->validate()) {
                    $flag = $model->save(false);
                    if ($flag == true) {
                        $transaction->commit();
                        return Json::encode(array('status' => 'success', 'type' => 'success', 'message' => 'Application created successfully.'));
                    } else {
                        $transaction->rollBack();
                    }
                } else {
                    return Json::encode(array('status' => 'warning', 'type' => 'warning', 'message' => 'Application can not created.'));
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
            }
        }
*/
        return $this->renderAjax('app-addprofile', [
            'model' => $model,
        ]);
    }

}
