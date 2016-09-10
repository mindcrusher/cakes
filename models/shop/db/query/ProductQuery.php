<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 14:02
 */

namespace app\models\shop\db\query;


use app\models\shop\db\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    public function init()
    {
        $this->from(['products' => Product::tableName()]);
        parent::init();
    }
}