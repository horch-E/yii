<?php
namespace common\models;

use yii\base\Model;
use common\models\Leavelog;
use common\models\process;
/**
 * leave form
 */
class LeaveForm extends Model
{
    public $leave_id;
    public $detail;
    public $begin_time;
    public $end_time;
    public $vetter_id; //审批人

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_id','begin_time', 'end_time','detail','vetter_id'], 'required'],
            [['leave_id','vetter_id'], 'integer'],
            [['detail'], 'string', 'max' => 500],   
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'leave_id' => '请教类型',
            'detail' => '原因',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'vetter_id'=> '审批人'
        ];
    }

    /**
     * 创建新的请教记录
     */
    public function Newleave($id)
    {
        if (!$this->validate()) {
            return null;
        }
        $leavelog = new leavelog();
        $leavelog->initiator_id = $id;
        $leavelog->leave_id = $this->leave_id;
        $leavelog->detail = $this->detail;
        $leavelog->begin_time = $this->begin_time;
        $leavelog->end_time = $this->end_time;
        $leavelog->status = leavelog::STATUS_UNDO;
        if($leavelog->save()){
            $process = new process();
            $process->log_id = $leavelog->id;
            $process->user_id = $this->vetter_id;
            $process->status = 0;
            $process->sort = 1;
            if($process->save())
                return 1;
            else 
                return null;
        }else{
            return null;
        }
    }

}
