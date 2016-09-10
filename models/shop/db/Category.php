<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 19:56
 */

namespace app\models\shop\db;


use app\components\linkable\Linkable;
use app\models\shop\db\query\CategoryQuery;
use yii\db\ActiveRecord;

/**
 * Class Category
 * @package app\models\shop\db
 *
 *
 * @property integer $id
 * @property string $name
 */

class Category extends ActiveRecord implements Linkable
{
    public static function tableName()
    {
        return 'shop_category';
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->via('categoryProducts')->orderBy('id');
    }

    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProducts::className(), ['category_id' => 'id'])->where(['is_active' => true]);
    }

    public function getUrl()
    {
        return [
            '/category/view',
            'id' => $this->id
        ];
    }
}