<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.09.2016
 * Time: 15:56
 */

namespace app\models\shop\form;


use app\components\Helper;
use yii\base\Model;

class Customer extends Model
{
    public $firstName = 'Сладкоежка';
    public $middleName;
    public $lastName = 'Вафельный';
    public $phone = '8(926)344-34-24';
    public $email = 'test@example.com';
    public $address;
    public $pickupDate = '2016-09-22 18:00';

    public function attributeLabels()
    {
        return [
            'firstName' => 'Имя',
            'middleName' => 'Отчество',
            'lastName' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'pickupDate' => 'Дата забора',
        ];
    }

    /**
     * @return array
     */
    public function mapToModel()
    {
        return [
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'phone' => Helper::phonePrepare($this->phone),
            'email' => $this->email,
        ];
    }

    public function rules()
    {
        return [
            [['firstName', 'middleName', 'lastName', 'pickupDate', 'phone'], 'safe'],
            [['email'], 'email']
        ];
    }
}