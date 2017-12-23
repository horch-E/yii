<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Show';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-about">
    <h1><?= Html::encode($this->title) ?></h1>
   <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        //'id',
        // 'initiator_id',
        [
            'label'=>'请假人',
            'value'=>$model->initiator->username,
        ],
        //'leave_id',
        [
            'label'=>'请假类型',
            'value'=>$model->leave->type,
        ],
        // 'create_time:datetime',
        // 'begin_time:datetime',
        // 'end_time:datetime',
        [   'attribute'=>'create_time',
            'value' =>date('Y-m-d H:i:s',$model->create_time),
        ],
        [   'attribute'=>'begin_time',
            'value' =>date('Y-m-d H:i:s',$model->create_time),
        ],
        [   'attribute'=>'end_time',
            'value' =>date('Y-m-d H:i:s',$model->create_time),
        ],
        
        //'status',
        [
            'label'=>'请假状态',
            'value'=>$model->status0->name,
        ],
    ],
])?> 

</div>
