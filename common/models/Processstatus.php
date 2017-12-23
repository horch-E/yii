<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "processstatus".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 */
class Processstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'processstatus';
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
}
