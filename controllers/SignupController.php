<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\CountrySearch;
use app\models\SignupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\LoginSearch;
use yii\data\Pagination;

/**
 * SignupController implements the CRUD actions for Users model.
 */
class SignupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public  function actionLogout(){

        Yii::$app->user->logout();

        return $this->redirect(['login']);

    }


    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['home']);
        }
        else{
            $model = new LoginSearch();

            if ($model->load(Yii::$app->request->post())&& $model->login())
                return $this->redirect(['home']);
            else
                return $this->redirect(['login']);

        }


    }

    public function actionLogin(){

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('home');
        }else{
            $model = new LoginSearch();

            if ($model->load(Yii::$app->request->post()) && $model->login())
                return $this->redirect(['home']);
            else
                return $this->render('login',['model'=>$model]);

        }
    }

    public function actionHome()
    {

            if(!Yii::$app->user->isGuest) {


                $query = User::find();


                $countries = $query->all();


                $events = array();
                foreach ( $countries as $value){


                    //Testing
                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = 3;
                    $Event->title = 'Testing';
                    $Event->color=$value->color;
                    $Event->start = date('Y-m-d\Th:m:s\Z');
                    $events[] = $Event;

                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = 4;
                    $Event->title = 'Testing';
                    $Event->color=$value->color;
                    $Event->start = date('Y-m-d\Th:m:s\Z',strtotime('tomorrow 6am'));
                    $events[] = $Event;
                }

                foreach ( $countries as $value){


                    //Testing
                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = 1;
                    $Event->title = 'Testing';
                    $Event->color=$value->color;
                    $Event->start = date('2016-10-16\Th:m:s\Z');
                    $events[] = $Event;

                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = 2;
                    $Event->title = 'Testing';
                    $Event->color=$value->color;
                    $Event->start = date('2016-10-10\Th:m:s\Z');
                    $events[] = $Event;
                }

                $user=new User();
                return $this->render('home',['events'=>$events,
                    'model' => $user,
                ]);
            }else{
                return $this->redirect(['login']);
            }
    }
    public function actionProfile(){

        if(!Yii::$app->user->isGuest) {
            $model = User::findOne(Yii::$app->user->identity->id);
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['home']);
            }else
                return $this->render('profile',[ 'model' => $model,]);
        }
        else{
            return $this->redirect(['login']);
        }

    }



    public function actionUpdate(){
        return $this->redirect(['home']);
    }
    public function actionSignup()
    {
        if(Yii::$app->user->isGuest){
            $model = new User();
            if ($model->load(Yii::$app->request->post())&& Yii::$app->user->isGuest) {

                $model->setPassword($model->password);

                $model->generateAuthKey();

                if (Yii::$app->request->isPost){

                    if(UploadedFile::getInstance($model, 'avatar'))
                    {
                        $avatar = UploadedFile::getInstance($model, 'avatar');

                        $type=substr($avatar->type,6);

                        $today = new \DateTime('now');

                        $avatar->saveAs('avatar/' . $today->date . '.' . $type);

                        $model->avatar='avatar/' . $today->date . '.' . $type;
                    }
                    else
                        $model->avatar='NULL';
                }

                if($model->save())
                    return $this->redirect(['login', 'model' => $model]);

            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->redirect(['home']);
        }


    }



    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/


    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

}
