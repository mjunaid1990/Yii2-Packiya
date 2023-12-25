<?php

namespace app\modules\admin\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use app\models\ProductImages;
use Yii;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
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
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Products();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $images = UploadedFile::getInstances($model, 'images');
                
                
                $image2 = UploadedFile::getInstance($model, 'description_image');
                if ($image2) {
                    $str = str_replace(' ', '-', $image2->name);
                    $filename2 = $str;
                    $model->description_image = $filename2;
                }

                $image3 = UploadedFile::getInstance($model, 'overview_image');
                if ($image3) {
                    $str = str_replace(' ', '-', $image3->name);
                    $filename3 = $str;
                    $model->overview_image = $filename3;
                }
                if ($model->save()) {
                    $directoryPath = 'uploads/products/'.$model->id;
                    // Check if the directory exists
                    if (!is_dir($directoryPath)) {
                        // If it doesn't exist, create it
                        FileHelper::createDirectory($directoryPath);
                    }
                    
                    if ($images) {
                        foreach ($images as $image) {
                            if($image->name) {
                                $str = str_replace(' ', '-', $image->name);
                                $filename = $str;

                                $productImageModel = new ProductImages();
                                $productImageModel->product_id = $model->id;
                                $productImageModel->order_no = $model->order_no;
                                $productImageModel->image = $filename;
                                if($productImageModel->save()) {

                                    $directoryPath_ = 'uploads/products/gallery/'.$productImageModel->id;
                                    // Check if the directory exists
                                    if (!is_dir($directoryPath_)) {
                                        // If it doesn't exist, create it
                                        FileHelper::createDirectory($directoryPath_);
                                    }
                                    $image->saveAs('uploads/products/gallery/'.$productImageModel->id.'/'.$filename);
                                }
                            }
                        }
                    }
                    if ($image2) {
                        $image2->saveAs('uploads/products/'.$model->id.'/'.$filename2);
                    }
                    if ($image3) {
                        $image3->saveAs('uploads/products/'.$model->id.'/'.$filename3);
                    }
                    Yii::$app->session->setFlash('success', "Saved Successfully.");
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $description_image = $model->description_image;
        $overview_image = $model->overview_image;
        $main_image = $model->image;
        if ($this->request->isPost && $model->load($this->request->post())) {
            
            $images = UploadedFile::getInstances($model, 'images');
            
            
            $image2 = UploadedFile::getInstance($model, 'description_image');
            if ($image2) {
                $str = str_replace(' ', '-', $image2->name);
                $filename2 = $str;
                $model->description_image = $filename2;
            }else {
                $model->description_image = $description_image;
            }

            $image3 = UploadedFile::getInstance($model, 'overview_image');
            if ($image3) {
                $str = str_replace(' ', '-', $image3->name);
                $filename3 = $str;
                $model->overview_image = $filename3;
            }else {
                $model->overview_image = $overview_image;
            }
            if ($model->save()) {
                
                $directoryPath = 'uploads/products/'.$model->id;
                // Check if the directory exists
                if (!is_dir($directoryPath)) {
                    // If it doesn't exist, create it
                    FileHelper::createDirectory($directoryPath);
                }
                
                if ($images) {
                    foreach ($images as $image) {
                        if($image->name) {
                            $str = str_replace(' ', '-', $image->name);
                            $filename = $str;

                            $productImageModel = new ProductImages();
                            $productImageModel->product_id = $model->id;
                            $productImageModel->order_no = $model->order_no;
                            $productImageModel->image = $filename;
                            if($productImageModel->save()) {

                                $directoryPath_ = 'uploads/products/gallery/'.$productImageModel->id;
                                // Check if the directory exists
                                if (!is_dir($directoryPath_)) {
                                    // If it doesn't exist, create it
                                    FileHelper::createDirectory($directoryPath_);
                                }
                                $image->saveAs('uploads/products/gallery/'.$productImageModel->id.'/'.$filename);
                            }
                        }
                    }
                }
                if ($image2) {
                    $filepath=Yii::$app->basePath.'/uploads/products/'.$model->id.'/'.$description_image;
                    if(file_exists($filepath)) {
                        unlink($filepath);
                    }
                    $image2->saveAs('uploads/products/'.$model->id.'/'.$filename2);
                }
                if ($image3) {
                    $filepath=Yii::$app->basePath.'/uploads/products/'.$model->id.'/'.$overview_image;
                    if(file_exists($filepath)) {
                        unlink($filepath);
                    }
                    $image3->saveAs('uploads/products/'.$model->id.'/'.$filename3);
                }
                Yii::$app->session->setFlash('success', "Saved Successfully.");
                return $this->redirect(['index']);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $filepath=Yii::$app->basePath.'/uploads/products/'.$model->id.'/'.$model->description_image;
        $filepath_b=Yii::$app->basePath.'/uploads/products/'.$model->id.'/'.$model->overview_image;
        $filepath_c=Yii::$app->basePath.'/uploads/products/'.$model->id.'/'.$model->image;
        if(file_exists($filepath)) {
            unlink($filepath);
        }
        
        if(file_exists($filepath_b)) {
            unlink($filepath_b);
        }
        
        if(file_exists($filepath_c)) {
            unlink($filepath_c);
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteGallery($id) {
        $model = ProductImages::findOne($id);
        $filepath=Yii::$app->basePath.'/uploads/products/gallery/'.$model->id.'/'.$model->image;
        if(file_exists($filepath)) {
            unlink($filepath);
        }
        $mid = $model->product_id;
        $model->delete();

        return $this->redirect(['update', 'id'=>$mid]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
