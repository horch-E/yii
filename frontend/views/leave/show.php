<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
$this->title = 'Show';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($leavelogs as $leavelog): ?>
   <?= DetailView::widget([
    'model' => $leavelog,
    'attributes' => [
        //'id',
        // 'initiator_id',
        // [
        //     'label'=>'请假人',
        //     'value'=>$leavelog->initiator->username,
        // ],
        //'leave_id',
        [
            'label'=>'请假类型',
            'value'=>$leavelog->leave->type,
        ],
        'detail',
        'begin_time',
        'end_time',
        [
            'label'=>'请假状态',
            'value'=>$leavelog->status0->name,
        ],
        [   'attribute'=>'create_time',
            'value' =>date('Y-m-d H:i:s',$leavelog->create_time),
        ],
    ],
])?> 
<?php endforeach; ?>
<?= LinkPager::widget(['pagination' => $Pagination]) ?>
</div>
