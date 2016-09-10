<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 19:56
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

class CategoryProducts extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop.category_products';
    }
}