<?php

use app\models\shop\db\Category;
use app\models\shop\db\CategoryProducts;
use \app\models\shop\db\OrderProducts;
use app\models\shop\db\Measure;
use app\models\shop\db\Product;
use yii\db\Migration;

class m160909_182441_fill_test_data extends Migration
{
    public function safeUp()
    {
        $this->batchInsert(Category::tableName(), ['id', 'name'], [
            [1, 'Торты'],
            [2, 'Капкейки'],
        ]);

        $this->batchInsert(Measure::tableName(), ['id', 'name', 'minimal_amount'], [
            [1, 'шт.', 10],
            [2, 'кг.', 2],
        ]);

        $this->batchInsert(Product::tableName(), ['id', 'name', 'measure_id', 'price'], [
            [1, 'Торт Птичье молоко', 2, 1000.00],
            [2, 'Торт Прага', 2, 1200.00],
            [3, 'Торт Муравейник', 2, 1100.00],
            [4, 'Торт Nyan Cat', 2, 1500.00],
            [5, 'Капкейк Миньон',1, 200.00],
            [6, 'Капкейк Тачки', 1, 150.00],
        ]);

        $this->batchInsert(CategoryProducts::tableName(),['category_id', 'product_id', 'is_active'], [
            [1, 1, true],
            [1, 2, true],
            [1, 3, true],
            [1, 4, true],
            [2, 5, true],
            [2, 6, true],
        ]);
    }

    public function safeDown()
    {
        $this->delete(OrderProducts::tableName(),['product_id' => [1,2,3,4,5,6]]);
        $this->delete(CategoryProducts::tableName(),['product_id' => [1,2,3,4,5,6]]);
        $this->delete(Measure::tableName(),['id' => [1,2]]);
        $this->delete(Product::tableName(),['id' => [1,2,3,4,5,6]]);
        $this->delete(Category::tableName(),['id' => [1,2]]);
    }
}
