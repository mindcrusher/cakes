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
 * Class Customer
 * @package app\models\shop\db
 *
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $creation_date
 * @property string $modification_date
 */
class Customer extends ActiveRecord
{
    public static function tableName()
    {
        return 'shop_customers';
    }

    /**
     * Возвращает ФИО
     * @return mixed
     */
    public function getName()
    {
        return sprintf('%s %s %s', $this->first_name, $this->middle_name, $this->last_name);
    }
}