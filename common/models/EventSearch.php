<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\base\Model;


class EventSearch extends Event {

  public $created_time;
  public $last_modified_time;
  public $name_fi;
  public $name_en;
  public $name_sv;
  public $id_event;
  
      public function rules()
    {
        return [
            [['name_fi', 'name_en', 'name_sv'], 'string'],
            [['created_time', 'last_modified_time'], 'datetime'],
            [['id_event'], 'number'],
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
    public function search($params)
    {
        $query = Event::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->defaultOrder = ['last_modified_time' => 'SORT_DESC'];

        // grid filtering conditions
        $query->andFilterWhere([
            'id_event' => $this->id_event,
  
        ]);

        $query->andFilterWhere(['like', 'name_fi', $this->name_fi])
            ->andFilterWhere(['like', 'name_fi', $this->name_en])
            ->andFilterWhere(['like', 'name_fi', $this->name_sv]);

        return $dataProvider;
    }
}
