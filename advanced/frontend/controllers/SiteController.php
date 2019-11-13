<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\data\Pagination;
use common\models\LoginForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\EntryForm;
use frontend\models\UserShow;
use frontend\models\UserAd;
use frontend\models\UserCity;
use frontend\models\AdCategory;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $cit = Yii::$app->request->get('cit');
        $cat = Yii::$app->request->get('cat');



        if(!empty($cit) && empty($cat)) {
            $query = UserAd::find()
                ->where('city_id=:cit',[':cit' => $cit]);
        }
        else if(empty($cit) && !empty($cat)) {
            $query = UserAd::find()
                ->where('category_id=:cat',[':cat' => $cat]);
        }
        else if(!empty($cit) && !empty($cat)) {
            $query = UserAd::find()
                ->where('city_id=:cit',[':cit' => $cit])
                ->andWhere('category_id=:cat',[':cat' => $cat]);
        } else {
            $query = UserAd::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);



        if(!empty($cit) && empty($cat)) {
            $userAds = $query->orderBy('header')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->where('city_id=:cit',[':cit' => $cit])
                //->leftJoin('photo_ad', '"user_ad"."id" = "photo_ad"."ad_id"')
                ->with('adPhotos')
                ->all();
        }
        else if(empty($cit) && !empty($cat)) {
            $userAds = $query->orderBy('header')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->where('category_id=:cat',[':cat' => $cat])
                //->leftJoin('photo_ad', '"user_ad"."id" = "photo_ad"."ad_id"')
                ->with('adPhotos')
                ->all();
        }
        else if(!empty($cit) && !empty($cat)) {
            $userAds = $query->orderBy('header')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->where('city_id=:cit',[':cit' => $cit])
                ->andWhere('category_id=:cat',[':cat' => $cat])
                //->leftJoin('photo_ad', '"user_ad"."id" = "photo_ad"."ad_id"')
                ->with('adPhotos')
                ->all();
        } else {
            $userAds = $query->orderBy('header')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                //->leftJoin('photo_ad', '"user_ad"."id" = "photo_ad"."ad_id"')
                ->with('adPhotos')
                ->all();
        }

        $cities = UserCity::find()
            //->where(['status' => Cities::STATUS_ACTIVE])
            //->andWhere('country_id=:id',[':id' => $id])
            ->orderBy('city_name')
            ->all();
        $selectCity = '<option value="">Выберите город...</option>\n';
        foreach ($cities as $city) {
            $selectCity .= '<option value="' . $city->id . '">' . $city->city_name . '</option>';
        }

        $categories = AdCategory::find()
            ->orderBy('name')
            ->all();
        $selectCategory = '<option value="">Выберите категорию...</option>\n';
        foreach ($categories as $category) {
            $selectCategory .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }

        return $this->render('indexBulletinBoard', [
            'userAds' => $userAds,
            'selectCity' =>  $selectCity,
            'selectCategory' => $selectCategory,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex_Old2()
    {
        $query = \app\models\UserDesc::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $userDesc = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->one();

        $users = $userDesc->getUsers()
            ->orderBy('username')
            ->one();

        return $this->render('indexBulletinBoard', [
            'userDesc' => $userDesc,
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function actionIndex_old()
    {
        //return $this->render('index');

        $query = UserShow::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $users = $query->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('indexListView', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

        // Pajax query

    public function actionIndexPajaxGridView()
    {
        $array = [
            ['id'=>1, 'name'=>'Sam','age'=> '21', 'height'=> '190'],
            ['id'=>2, 'name'=>'John','age'=> '34', 'height'=> '156'],
            ['id'=>3, 'name'=>'Alex','age'=> '29', 'height'=> '178'],
            ['id'=>4, 'name'=>'David','age'=> '31', 'height'=> '188'],
            ['id'=>5, 'name'=>'Max','age'=> '26', 'height'=> '184'],
        ];

        $searchModel = [
            'age' => Yii::$app->request->getQueryParam('filterage', ''),
        ];

        $filteredData = array_filter($array, function($item) use ($searchModel) {
            if (!empty($searchModel['age'])) {
                if ($item['age'] == $searchModel['age']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        });

        $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'id',
            'allModels' => $filteredData,
            'sort' => [
                'attributes' => ['name'],
            ],
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        return $this->render('indexPajaxGridView', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs in a user. Login in the maodal window.
     *
     * @return mixed
     */

    public function actionLoginModal()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->renderAjax('loginModal', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Logs in a user. Login from madal window
     *
     * @return mixed
     */

    public function actionLoginFromModal()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->goHome();
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }







    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

}
