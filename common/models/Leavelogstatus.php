<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "leavelogstatus".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 *
 * @property Leavelog[] $leavelogs
 */
class Leavelogstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leavelogstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 20],
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeavelogs()
    {
        return $this->hasMany(Leavelog::className(), ['status' => 'type']);
    }
}
