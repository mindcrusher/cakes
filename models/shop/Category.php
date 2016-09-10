<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.09.2016
 * Time: 13:53
 */

namespace app\models\shop;

use \app\models\shop\db\Category as CategoryModel;

class Category
{
    public static function getMenu()
    {
        /** @var CategoryModel[] $cat */
        $cat = CategoryModel::find()->all();
        $menu = [];
        foreach ($cat as $item) {
            $menu[] = ['label' => $item->name, 'url' => $item->getUrl()];
        }

        return ['items' => $menu];
    }
}