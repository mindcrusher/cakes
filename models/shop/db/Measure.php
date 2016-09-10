<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.09.2016
 * Time: 13:23
 */

namespace app\models\shop\db;


use yii\db\ActiveRecord;

/**
 * Class Measure
 * @package app\models\shop\db
 *
 * @property string $name
 * @property integer $id
 */

class Measure extends ActiveRecord
{
    /**
     * MEASURE_WEIGHT - ID единицы измерения веса
     */
    const MEASURE_WEIGHT = 1;

    public static function tableName()
    {
        return 'shop_measure';
    }

    public function ignoreQuantity()
    {
        return $this->id == self::MEASURE_WEIGHT;
    }

}