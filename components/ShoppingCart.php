<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.09.2016
 * Time: 1:00
 */

namespace app\components;


use app\models\shop\form\Product;

class ShoppingCart extends \yz\shoppingcart\ShoppingCart
{
    /**
     * @return int
     */
    public function getCount()
    {
        $count = 0;
        foreach ($this->_positions as $position)
            /** @var Product $position */
            $count += $position->getPosition()->measure->ignoreQuantity() ? $position->getQuantity() : 1;
        return $count;
    }
}