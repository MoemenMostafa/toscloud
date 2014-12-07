<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Part;

/**
 * PartSearch represents the model behind the search form about `app\models\Part`.
 */
class PartSearch extends Part
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'text_id', 'contentOrder'], 'integer'],
            [['content', 'timestamp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($id,$params)
    {
        $query = Part::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>array(
              'pageSize'=>0,
            ),
        ]);
        $query->andFilterWhere([
            'text_id' => $id,
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'text_id' => $this->text_id,
            'contentOrder' => $this->contentOrder,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
