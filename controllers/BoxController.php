<?php

namespace app\controllers;

use app\models\BoxSearch;
use Yii;
use app\models\Box;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BoxController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BoxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $model = new Box();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->calculateVolume();
            $model->checkQuantities();
            $model->calculateTotalValue();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->calculateVolume();
            $model->checkQuantities();
            $model->calculateTotalValue();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Box::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdateStatusMultiple()
    {
        $selectedBoxes = Yii::$app->request->post('selection');
        $status = Yii::$app->request->post('status');

        if ($selectedBoxes && isset($status[0])) {

            $idString = implode(',', array_map('intval', $selectedBoxes));

            Box::updateAll(['status' => $status[0]],  "id in ($idString)");
        }

        return $this->redirect(['index']);
    }
}
