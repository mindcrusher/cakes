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

<h1>Заказ #<?=$order->order_id?> успешно зарегистрирован!</h1>
<p class="lead">Вы сможете забрать Ваш заказ <?=$formatter->format($order->pickup_date, 'date')?> в <?=$formatter->format($order->pickup_date, 'time')?></p>
<p class="lead">Для Вас будут приготовлены:</p>
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
    Сумма Вашего заказа: <?=$order->amount()?> руб.
</p>
