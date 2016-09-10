<?php

namespace app\controllers;

use app\models\shop\form\Product;
use yii;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionAdd()
    {
        $model = $this->getModel();
        Yii::$app->cart->put($model, $model->amount);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        $model = $this->getModel($id);
        Yii::$app->cart->remove($model);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate()
    {
        $data = Yii::$app->request->post('Product');
        if ($data['amount']) {
            foreach ($data['amount'] as $id => $count) {
                $model = $this->getModel($id);
                Yii::$app->cart->update($model, $count);
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionIndex()
    {
//        Yii::$app->cart->removeAll();
        $positions = Yii::$app->cart->getPositions();
        $provider = new yii\data\ArrayDataProvider([
            'allModels' => $positions
        ]);
        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @param null $id
     * @return Product
     */
    private function getModel($id = null)
    {
        $model = new Product();
        if (!$id) {
            $model->load(Yii::$app->request->post());
        } else {
            $model->id = $id;
        }

        return $model;
    }
}