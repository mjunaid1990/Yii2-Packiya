<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductChildCategories;
use app\models\ProductChildCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * ProductChildCategoriesController implements the CRUD actions for ProductChildCategories model.
 */
class ProductChildCategoriesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProductChildCategories models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductChildCategoriesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductChildCategories model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductChildCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductChildCategories();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if ($image) {
                    $str = str_replace(' ', '-', $image->name);
                    $filename = $str;
                    $model->image = $filename;
                }
                if ($model->save()) {
                    $directoryPath = 'uploads/categories/'.$model->id;
                    // Check if the directory exists
                    if (!is_dir($directoryPath)) {
                        // If it doesn't exist, create it
                        FileHelper::createDirectory($directoryPath);
                    }
                    
                    
                    if ($image) {
                        $image->saveAs('uploads/categories/'.$model->id.'/'.$filename);
                    }

                    Yii::$app->session->setFlash('success', "Saved Successfully.");
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductChildCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->image;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if ($image) {
                    $str = str_replace(' ', '-', $image->name);
                    $filename = $str;
                    $model->image = $filename;
                }else {
                    $model->image = $old_image;
                }
                if ($model->save()) {
                    if ($image) {
                        $directoryPath = 'uploads/categories/'.$model->id;
                        // Check if the directory exists
                        if (!is_dir($directoryPath)) {
                            // If it doesn't exist, create it
                            FileHelper::createDirectory($directoryPath);
                        }
                        
                        $filepath=Yii::$app->basePath.'/uploads/categories/'.$model->id.'/'.$old_image;
                        if(file_exists($filepath) && !empty($old_image)) {
                            unlink($filepath);
                        }
                        
                        $image->saveAs('uploads/categories/'.$model->id.'/'.$filename);
                    }

                    Yii::$app->session->setFlash('success', "Saved Successfully.");
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductChildCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        $filepath=Yii::$app->basePath.'/uploads/categories/'.$model->id.'/'.$model->image;
        if(file_exists($filepath) && $model->image) {
            unlink($filepath);
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductChildCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductChildCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductChildCategories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
