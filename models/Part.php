<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property integer $id
 * @property integer $text_id
 * @property string $content
 * @property string $timestamp
 *
 * @property Comment[] $comments
 * @property Text $text
 * @property Score[] $scores
 */
class Part extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_id'], 'integer'],
            [['content'], 'string'],
            [['timestamp'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_id' => 'Text ID',
            'content' => 'Content',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScores()
    {
        return $this->hasMany(Score::className(), ['part_id' => 'id']);
    }
}
