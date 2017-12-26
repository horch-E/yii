<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\grid\GridView;

$this->title = 'Show';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-about">
    <h1><?= Html::encode($this->title) ?></h1>
       <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                        if($model->status == '0'){
                           //return ['style'=>'color:white;'];
                        }elseif($model->status == '1'){
                           return ['class' => 'success'];
                        }elseif($model->status == '2'){
                           return ['class' => 'warning'];
                        }elseif($model->status == '3'){
                           return ['class' => 'danger'];
                        }
                    },
            'columns' => [
                // 'id',
                // [
                //     'attribute'=>'initiator_id',
                //     'value'=>'initiator.username',
                // ],
                [
                    'attribute'=>'leave_id',
                    'value'=>'leave.type',
                    'contentOptions'=>['width'=>'45px'],
                ],
                [
                    'attribute'=>'detail',
                    'contentOptions'=>['width'=>'400px'],
                ],
                [
                    'attribute'=>'begin_time',
                    'contentOptions'=>['width'=>'95px'],
                ],
                [
                    'attribute'=>'end_time',
                    'contentOptions'=>['width'=>'95px'],
                ],
                [
                    'attribute'=>'status',
                    'value'=>'status0.name',
                    'contentOptions'=>['width'=>'75px'],
                ],
                [   'attribute'=>'create_time',
                    'format'=>['date','php:Y-m-d H:i:s'],
                    // 'value' => function ($model) {
                    //         return date('Y-m-d H:i:s', $model->create_time);
                    //         },
                    'contentOptions'=>['width'=>'160px'],
                ],
                [
                    "class" => "yii\grid\ActionColumn",
                    "template" => "{view}",
                    "header" => "操作",
                    "buttons" => [
                        "view" => function ($url, $model, $key) { 
                            return Html::a("查看详情", $url, ["title" => "获取xxx"] ); 
                        },
                    ],
                    'contentOptions'=>['width'=>'75px'],
                ],

            ],
        ]) ?>
</div>
