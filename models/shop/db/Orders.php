<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2016
 * Time: 8:57
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

class Orders extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop.orders';
    }
}