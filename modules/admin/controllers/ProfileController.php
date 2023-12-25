<?php

namespace app\modules\admin\controllers;
use yii;
use yii\web\Controller;
use app\components\AController;
use app\models\Users;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * Default controller for the `admin` module
 */
class ProfileController extends AController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {
        $model = $this->findModel($id);
        $old_password = $model->password;
        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->newpassword)) {
                $model->password = $model->setPassword($model->newpassword);
            }
            $model->save();
            Yii::$app->session->setFlash('success', "Saved Successfully.");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
