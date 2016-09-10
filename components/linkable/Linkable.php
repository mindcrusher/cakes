<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 10:46
 */

namespace app\components\linkable;


interface Linkable
{
    /**
     * Возвращает массив для использования urlBuilder`ом
     * @return array
     */
    public function getUrl();
}