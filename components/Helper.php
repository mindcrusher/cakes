<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.09.2016
 * Time: 22:40
 */

namespace app\components;


class Helper
{
    /**
     * @param string $phone
     * @return integer
     */
    public static function phonePrepare($phone)
    {
        return preg_replace('#[^\d]#', '', $phone);
    }
}