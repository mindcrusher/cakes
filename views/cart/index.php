<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.09.2016
 * Time: 12:10
 */

/**
 * @var \yii\web\View $this
 */
use \app\models\shop\form\Product;
use \yii\helpers\Html;

$this->registerCssFile('/packages/cart/css/style.css');
$this->registerJsFile('/packages/cart/js/cart.js', [
    'depends' => '\app\assets\AppAsset'
]);

$customer = new \app\models\shop\form\Customer();
?>
<span class="h2">Ваша корзина</span>
<?php
$form = \yii\widgets\ActiveForm::begin(['id' => 'cart']);
echo \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'layout' => '{items}',
    'columns' => [
        [
            'header' => 'Продукт',
            'value' => function (Product $model) {
                return $model->getPosition()->name;
            }
        ],
        [
            'header' => '',
            'value' => function (Product $model) use ($form) {
                return '<div class="col-xs-3">' . Html::activeTextInput($model, 'amount['.$model->id.']', [
                    'class' => 'form-control',
                    'value' => $model->getQuantity()
                ])
                . '</div><div class="col-xs-3 row cart-measures">' . $model->getPosition()->measure->name . '</div>';
            },
            'format' => 'raw'
        ],
        [
            'value' => function (Product $model) {
                return \yii\helpers\Html::a('Удалить',['cart/delete', 'id' => $model->getId()], ['class' => 'btn btn-warning']);
            },
            'format' => 'raw'
        ]
    ]
]);
?>
<div class="row">
    <div class="col-sm-6">
        <?=Html::button('Обновить', ['class' => 'btn btn-primary', 'id' => 'update-cart']);?>
    </div>
    <div class="col-sm-6">
        <?=Html::button('Оформить заказ', ['class' => 'btn btn-success pull-right', 'id' => 'order-cart']);?>
    </div>
</div>
<?php $form->end();?>

<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'customer', 'action' => ['/order/checkout'], 'options' => ['style' => 'display:none']]);?>
<div class="h2">&nbsp;</div>
<span class="h2">Контактные данные</span>
<div class="row">
    <div class="col-sm-3">
        <?=$form->field($customer, 'pickupDate');?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?=$form->field($customer, 'firstName');?>
    </div>
    <div class="col-sm-3">
        <?=$form->field($customer, 'middleName');?>
    </div>
    <div class="col-sm-3">
        <?=$form->field($customer, 'lastName');?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?=$form->field($customer, 'phone')->textInput(['placeholder' => '8(916) 123 45 56']);?>
    </div>
    <div class="col-sm-3">
        <?=$form->field($customer, 'email')->textInput(['placeholder' => 'alex@gmail.com']);?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?=Html::submitButton('Подтвердить', ['class' => 'btn btn-success pull-right']);?>
    </div>
</div>
<?php $form->end();?>

