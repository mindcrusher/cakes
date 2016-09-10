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
 * Class Order
 * @package app\models\shop\db
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $customer_id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $pickup_date
 * @property OrderProducts $ordersProducts
 * @property Product $products
 */
class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop.orders';
    }

    public function amount()
    {
        $amount = 0;
        foreach ($this->ordersProducts as $product) {
            $amount+= $product->price;
        }

        return $amount;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'id'])->via('ordersProducts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['order_id' => 'id']);
    }


    /**
     * @return static
     */
    public function generateID()
    {
        do {
            $this->order_id = mt_rand(100000,999999);
        } while (Order::find()->where(['order_id' => $this->order_id])->exists());

        return $this;
    }
}