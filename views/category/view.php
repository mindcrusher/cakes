<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 23:34
 */

echo \yii\widgets\ListView::widget(['dataProvider' => $dataProvider, 'itemView' => '_item']);