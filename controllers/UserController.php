<?php

namespace app\controllers;

use app\models\UserProject;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role==User::admin){
                $searchModel = new UserSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            return $this->redirect(['/home']);
        }else
            return $this->redirect(['/home']);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role==User::admin){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
            return $this->redirect(['/home']);
        }else
            return $this->redirect(['/home']);

    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role==User::admin) {
                $model = new User();


                if ($model->load(Yii::$app->request->post())) {

                    $model->setPassword($model->password,$model->password_2);

                    $model->generateAuthKey();

                    $model->status();

                    if (UploadedFile::getInstance($model, 'avatar')) {
                        $avatar = UploadedFile::getInstance($model, 'avatar');

                        $type = substr($avatar->type, 6);

                        $today = new \DateTime('now');

                        $avatar->saveAs('avatar/' . $today->date . '.' . $type);

                        $model->avatar = 'avatar/' . $today->date . '.' . $type;
                    }
                    if ($model->save())
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            return $this->redirect(['/home']);
        }else
            return $this->redirect(['/home']);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role==User::admin) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post())) {

                    $model->setPassword($model->password,$model->password_2);

                    if (UploadedFile::getInstance($model, 'avatar')) {
                        $avatar = UploadedFile::getInstance($model, 'avatar');

                        $type = substr($avatar->type, 6);

                        $today = new \DateTime('now');

                        $avatar->saveAs('avatar/' . $today->date . '.' . $type);

                        $model->avatar = 'avatar/' . $today->date . '.' . $type;
                    }
                    if ($model->save())
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            return $this->redirect(['/home']);
        }else
            return $this->redirect(['/home']);

    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role==User::admin) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            }
            return $this->redirect(['/home']);
        }else
            return $this->redirect(['/home']);

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddproject($id,$id_user){
        if((integer)$id && (integer)$id_user){
                $model = new UserProject();
                $model->get_AddUser_Project($id, $id_user);
        }
    }

    public function actionRemoveproject($id,$id_user){
        if((integer)$id && (integer)$id_user){
            UserProject::find()->where(['id_user' => $id_user, 'id_project' => $id])->one()->delete();
        }
    }




}
