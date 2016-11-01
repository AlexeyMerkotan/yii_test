<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\CountrySearch;
use app\models\SignupSearch;
use yii\web\UploadedFile;
use app\models\LoginSearch;
use yii\data\Pagination;
use app\models\UserSearch;


/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
            if(!Yii::$app->user->isGuest){
                if(Yii::$app->user->identity->role==User::admin) {
                    $searchModel = new ProjectSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                }
                return $this->redirect(['/home']);
            }
            else{
                return $this->redirect(['/home']);
            }



    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->role==User::admin) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
            return $this->redirect(['/home']);
        }
        else{
            return $this->redirect(['/home']);
        }

    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->role==User::admin) {
                $model = new Project();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            return $this->redirect(['/home']);
        }
        else{
            return $this->redirect(['/home']);
        }

    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->role==User::admin) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            return $this->redirect(['/home']);
        }
        else{
            return $this->redirect(['/home']);
        }

    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->role==User::admin) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            }
            return $this->redirect(['/home']);
        }
        else{
            return $this->redirect(['/home']);
        }

    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
