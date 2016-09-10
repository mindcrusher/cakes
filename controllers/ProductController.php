<?php

namespace app\controllers;

use app\models\shop\db\Category;
use app\models\shop\db\Product;
use yii;
use yii\web\Controller;

class ProductController extends Controller
{

    public function actionView($id)
    {
        /** @var Category $category */
        $product = Product::find()->where(['product.id' => $id])->one();

        return $this->render('view', [
            'product' => $product,
        ]);
    }
}