<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "leavelog".
 *
 * @property integer $id
 * @property integer $initiator_id
 * @property integer $leave_id
 * @property integer $detail
 * @property integer $create_time
 * @property integer $begin_time
 * @property integer $end_time
 * @property integer $status
 *
 * @property User $initiator
 * @property Leave $leave
 * @property Process[] $processes
 * @property leavelogstatus $status
 */
class Leavelog extends \yii\db\ActiveRecord
{

    const STATUS_UNDO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leavelog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['initiator_id', 'leave_id', 'create_time', 'begin_time', 'end_time','detail'], 'required'],
            [['initiator_id', 'leave_id', 'create_time', 'status'], 'integer'],
            [['initiator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['initiator_id' => 'id']],
            [['leave_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leave::className(), 'targetAttribute' => ['leave_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => leavelogstatus::className(), 'targetAttribute' => ['status' => 'type']],
            [['detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '记录ID',
            'initiator_id' => '请假人',
            'leave_id' => '请假类型',
            'detail' => '详情',
            'create_time' => '创建时间',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'status' => '状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitiator()
    {
        return $this->hasOne(User::className(), ['id' => 'initiator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeave()
    {
        return $this->hasOne(Leave::className(), ['id' => 'leave_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesses()
    {
        return $this->hasMany(Process::className(), ['log_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getstatus0()
    {
        return $this->hasOne(leavelogstatus::className(), ['type' => 'status']);
    }

    /**
    * 返回请假信息 by Initiator
    */
    static public function findlog($id)
    {
        return static::findOne(['initiator_id'=>$id]);
    }

}
