<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.09.2016
 * Time: 12:05
 */

namespace app\models\shop\form;


use yii\base\Model;
use yii\web\NotFoundHttpException;
use yz\shoppingcart\CartPositionTrait;

class Product extends Model
{
    use CartPositionTrait;

    public $id;
    public $amount = 1;

    /**
     * @param \app\models\shop\db\Product $product
     */
    public function importProduct(\app\models\shop\db\Product $product)
    {
        $this->setAttributes($product->attributes, false);
    }

    /**
     * @return \app\models\shop\db\Product
     * @throws NotFoundHttpException
     */
    public function getPosition()
    {
        $model = \app\models\shop\db\Product::findOne($this->id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }


    public function getPrice()
    {
        return $this->getPosition()->getPrice();
    }

    public function getId()
    {
        return $this->id;
    }

    public function rules()
    {
        return [
            [['id','amount'], 'integer']
        ];
    }
}