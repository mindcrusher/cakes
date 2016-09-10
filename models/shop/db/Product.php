<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 19:56
 */

namespace app\models\shop\db;


use app\components\linkable\Linkable;
use yii\db\ActiveRecord;
use app\models\shop\db\query\ProductQuery;

/** @property integer $id */

/**
 * @property string $name
 * @property integer $id
 * @property integer $price
 * @property Measure $measure
 * @property Photo[] $photo
 */
class Product extends ActiveRecord  implements Linkable
{
    public static function tableName()
    {
        return 'shop_product';
    }

    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id'])
            ->via('mainProductPhoto');
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['id' => 'photo_id'])
            ->via('productPhotos');
    }

    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhotos::className(), ['product_id' => 'id'])->where(['is_main' => false]);
    }

    public function getMainProductPhoto()
    {
        return $this->hasOne(ProductPhotos::className(), ['product_id' => 'id'])->where(['is_main' => true]);
    }
    
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getUrl()
    {
        return [
            '/product/view',
            'id' => $this->id
        ];
    }
}