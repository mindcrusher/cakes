<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.09.2016
 * Time: 23:51
 *
 * @var \app\models\shop\db\Product $model
 */
?>
<div class="row col-sm-3 text-center">
    <a href="<?=\yii\helpers\Url::to($model->getUrl())?>" class="col-xs-12">
        <img src="<?=$model->photo->src?>" width="100%"/>
        <?=$model->name?>
    </a>
</div>
