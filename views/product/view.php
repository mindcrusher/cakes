<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 23:48
 *
 * @var \app\models\shop\db\Product $product;
 */

use \yii\helpers\Html;

$model = new \app\models\shop\form\Product();
$model->importProduct($product);

$this->registerCssFile('/packages/product/css/style.css');
?>
<div class="row">
    <div class="col-sm-4"><img src="<?=$product->photo->src?>"/></div>
    <div class="col-sm-8">
        <h2><?=$product->name?></h2>
        Цена: <?=$product->getPrice()?>руб. за <?=$product->measure->name?>
        <?php
        $form = \yii\widgets\ActiveForm::begin([
            'id' => 'cart-from',
            'action' => ['cart/add']
        ]);
        ?>
        <div class="row">
            <div class="col-sm-2">
                <?=Html::activeHiddenInput($model, 'id');?>
                <?=Html::activeTextInput($model, 'amount', ['class' => 'form-control']);?>
            </div>
            <div class="col-sm-1 row measures">
                <?=$product->measure->name?>
            </div>
            <div class="col-sm-3">
                <?= \yii\helpers\Html::submitButton('Положить в корзину', ['class' => 'btn btn-success']);?>
            </div>
        </div>
        <?php $form->end(); ?>
    </div>
</div>