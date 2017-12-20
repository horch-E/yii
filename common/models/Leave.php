<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "leave".
 *
 * @property integer $id
 * @property string $type
 * @property string $desc
 * @property integer $status
 * @property integer $create_time
 * @property integer $updata_time
 *
 * @property Leavelog[] $leavelogs
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'create_time', 'updata_time'], 'required'],
            [['status', 'create_time', 'updata_time'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['desc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'desc' => 'Desc',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'updata_time' => 'Updata Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeavelogs()
    {
        return $this->hasMany(Leavelog::className(), ['leave_id' => 'id']);
    }
}
