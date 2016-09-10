<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 12:03
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

/**
 * Class Photo
 * @package app\models\shop\db
 *
 * @property boolean $is_active
 */
class Photo extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop_photo';
    }

    public function isActive()
    {
        return $this->is_active;
    }
}