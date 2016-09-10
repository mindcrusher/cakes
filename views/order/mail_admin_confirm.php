<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.09.2016
 * Time: 22:16
 */

/**
 * @var \app\models\shop\db\Order $order
 */

$formatter = Yii::$app->formatter;
?>

<h1>Зарегистрирован заказ #<?=$order->order_id?> </h1>
<p class="lead">Выполнить к <?=$formatter->format($order->pickup_date, 'date')?>  <?=$formatter->format($order->pickup_date, 'time')?></p>
<p class="lead">Состав: </p>
<?php
foreach ($order->ordersProducts as $position) {
?>
    <div>
        <span class="h4"><?=$position->product->name?>, <?=$position->amount?> <?=$position->product->measure->name?> </span>
    </div>
<?php
}
?>
<p class="lead">
    Сумма к оплате: <?=$order->amount()?> руб.
</p>
