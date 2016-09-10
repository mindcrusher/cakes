<?php

namespace app\controllers;

use app\models\shop\db\Category;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CategoryController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        /** @var Category $category */
        $category = Category::find()->joinWith(['products'])->where(['category.id' => $id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => $category->getProducts()
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
        ]);
    }
}