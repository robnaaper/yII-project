<?php

namespace app\controllers;

use app\models\Box;
use app\models\BoxCardSearch;
use PhpParser\Node\Expr\PreDec;
use Yii;
use app\models\BoxCard;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BoxCardController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new BoxCardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @throws Exception
     */
    public function actionCreate()
   {

        $model = new BoxCard();

        $boxes = Box::find()->select(['id', 'reference'])->all();
        $boxItems = ArrayHelper::map($boxes, 'id', 'reference');
        // Check if form data is being posted
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                return $this->redirect(['index', 'boxId' => $model->box_id]);
            } else {
                Yii::$app->session->setFlash('error', 'Unable to save BoxCard.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'boxItems' => $boxItems,
        ]);
    }




    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'boxId' => $model->box_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $model->delete();
        }

        return $this->redirect(['index', 'boxId' => $model->box_id]);
    }


    protected function findModel($id)
    {
        if (($model = BoxCard::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
