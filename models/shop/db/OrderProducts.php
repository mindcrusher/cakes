<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2016
 * Time: 8:57
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

/**
 * Class OrderProducts
 * @package app\models\shop\db
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $price
 * @property integer $amount
 * @property Product $product
 * @property string $creation_date
 * @property string $modification_date
 * @property string $pickup_date
 */
class OrderProducts extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop.orders_products';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}