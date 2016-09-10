<?php

use yii\db\Migration;
use app\models\shop\db\Order;
use app\models\shop\db\Measure;
use app\models\shop\db\Product;
use app\models\shop\db\Category;
use app\models\shop\db\Customer;
use app\models\shop\db\OrderProducts;
use app\models\shop\db\CategoryProducts;

class m160909_182342_create_shop extends Migration
{
    public function safeUp()
    {
        #$this->execute('CREATE SCHEMA shop');

        $this->createTable(Category::tableName(),[
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
        ]);

        $this->createTable(Product::tableName(),[
            'id' => $this->primaryKey(),
            'measure_id' => $this->integer(),
            'name' => $this->string(128),
            'description' => $this->string(128),
            'price' => $this->decimal(10, 2),
        ]);

        $this->createTable(Measure::tableName(),[
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
            'minimal_amount' => $this->integer(4),
        ]);

        $this->createTable(CategoryProducts::tableName(),[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
            'is_active' => $this->boolean(),
        ]);

        #$this->addForeignKey('products', CategoryProducts::tableName(), 'product_id', Product::tableName(), 'id');
        #$this->addForeignKey('category', CategoryProducts::tableName(), 'category_id', Category::tableName(), 'id');

        $this->createTable(Customer::tableName(),[
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'middle_name' => $this->string(),
            'last_name' => $this->string(),
            'email' => $this->char(50),
            'phone' => $this->bigInteger(),
            'creation_date' => $this->dateTime(),
            'modification_date' => $this->dateTime(),
        ]);

        $this->createTable(Order::tableName(),[
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'pickup_date' => $this->dateTime(),
            'creation_date' => $this->dateTime(),
            'modification_date' => $this->dateTime(),
        ]);

        $this->createIndex('order_id', Order::tableName(), 'order_id', true);
        #$this->addForeignKey('customer', Order::tableName(), 'customer_id', Customer::tableName(), 'id');

        $this->createTable(OrderProducts::tableName(),[
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->decimal(10, 2),
            'amount' => $this->integer(),
            'creation_date' => $this->dateTime(),
            'modification_date' => $this->dateTime(),
        ]);

        #$this->addForeignKey('products', OrderProducts::tableName(), 'product_id', Product::tableName(), 'id');
        #$this->addForeignKey('order', OrderProducts::tableName(), 'order_id', Order::tableName(), 'id');
    }

    public function safeDown()
    {
        $this->dropTable(CategoryProducts::tableName());
        $this->dropTable(OrderProducts::tableName());
        $this->dropTable(Order::tableName());
        $this->dropTable(Customer::tableName());
        $this->dropTable(Category::tableName());
        $this->dropTable(Measure::tableName());
        $this->dropTable(Product::tableName());
        #$this->execute('DROP SCHEMA shop');
    }
}
