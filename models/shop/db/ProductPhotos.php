<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 12:07
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

/**
 * Class ProductPhotos
 * @package app\models\shop\db
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $photo_id
 */
class ProductPhotos extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop.product_photos';
    }
}