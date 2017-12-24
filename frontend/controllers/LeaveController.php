<?php
namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\leave;
use common\models\leavelog;
use common\models\LeaveForm;
use yii\data\Pagination;
class LeaveController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
    * 新建请假
    */
    public function actionNew()
    {
        $id = Yii::$app->user->identity->id;
        $vetters = user::findVetter($id);
        $leaves = Leave::findleave();
        $model = new LeaveForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->Newleave($id)) {
                Yii::$app->session->setFlash('success', '请假申请成功，请等待处理信息');
            } else {
                Yii::$app->session->setFlash('error', '请假申请失败，稍后再试');
            }
            return $this->refresh();
        } else {
            return $this->render('new', ['model' => $model,'vetters'=>$vetters,'leaves'=>$leaves]);
        }
    }

    /**
    * 展示个人请假记录
    */
    public function actionShow()
    {
        $id = Yii::$app->user->identity->id;
        $query = leavelog::find()->where(['initiator_id'=>$id]);
        $Pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $leavelogs = $query->orderBy('create_time')
                ->offset($Pagination->offset)
                ->limit($Pagination->limit)
                ->all();

    	return $this->render('show',['leavelogs'=> $leavelogs,'Pagination'=>$Pagination]);
    }

}
