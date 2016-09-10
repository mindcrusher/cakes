<?php

use app\models\shop\db\Photo;
use app\models\shop\db\ProductPhotos;
use yii\db\Migration;

class m160910_090117_create_photos extends Migration
{
    public function safeUp()
    {
        $this->createTable(Photo::tableName(), [
            'id' => $this->primaryKey(),
            'src' => $this->string(),
            'is_active' => $this->string(),
        ]);


        $this->createTable(ProductPhotos::tableName(), [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'photo_id' => $this->integer(),
            'is_main' => $this->boolean(),
        ]);


        $this->insert(Photo::tableName(), ['id' => 1, 'src' => 'https://placeholdit.imgix.net/~text?txtsize=33&txt=250%C3%97250&w=250&h=250', 'is_active' => true]);

        $this->batchInsert(ProductPhotos::tableName(), ['product_id', 'photo_id', 'is_main'], [
            [1, 1, true],
            [2, 1, true],
            [3, 1, true],
            [4, 1, true],
            [5, 1, true],
            [6, 1, true],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(ProductPhotos::tableName());
        $this->dropTable(Photo::tableName());
    }
}
