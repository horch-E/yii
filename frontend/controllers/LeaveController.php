<?php
namespace frontend\controllers;

use common\models\leavelog;
class LeaveController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
    * 新建请假
    */
    public function actionNewleave()
    {
    	return 0;
    }

    /**
    * 展示个人请假记录
    */
    public function actionShow()
    {
    	$model = leavelog::findlog();
    	return $this->render('show',['model'=> $model ]);
    }

}
