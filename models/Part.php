<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property integer $id
 * @property integer $text_id
 * @property integer $contentOrder
 * @property string $content
 * @property string $timestamp
 *
 * @property Comment[] $comments
 * @property Text $text
 * @property Score[] $scores
 */
class Part extends \yii\db\ActiveRecord
{
    
    public $cnt;
    
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
            [['text_id','contentOrder'], 'integer'],
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
            'contentOrder' => 'Content Order',
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
    
    public function getScore($id,$value)
    {
        return \app\models\Score::find()->select(['*'])
                                        ->where("value = $value AND part_id=$id")
                                        ->count();
    }
    
    public function getStatus($id)
    {
        $up = \app\models\Score::find()->select(['*'])
                                        ->where("value =1 AND part_id=$id")
                                        ->count();
        $down = \app\models\Score::find()->select(['*'])
                                        ->where("value =0 AND part_id=$id")
                                        ->count();
        $result = $up - $down;
        
        if ($result > 0){
            return "green";
        }
        if ($result < 0){
            return "red";
        }
    }
}
