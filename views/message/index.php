<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="lead">
        Подпишитесь на телеграм-бот <a href="https://t.me/test_2021_04_28_bot">@test_2021_04_28_bot</a> и отправляйте сообщения!
    </p>

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text:ntext',

            [
                'class'         => 'yii\grid\ActionColumn',
                'header'        => 'Actions', 
                'headerOptions' => ['width' => '80'],
                'template'      => '{view} {link}',
            ],
        ],
    ]); ?>


</div>
