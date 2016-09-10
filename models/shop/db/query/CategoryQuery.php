<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 14:02
 */

namespace app\models\shop\db\query;


use app\models\shop\db\Category;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function init()
    {
        $this->from(['category' => Category::tableName()]);
        parent::init();
    }
}