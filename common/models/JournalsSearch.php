<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\base\Model;


class JournalsSearch extends Journals
{

	public function rules()
		{
			return [
				[['title', 'description', 'created_at'], 'safe'],
			];
		}

	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Journals::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
      	'defaultOrder' => ['created_at' => SORT_DESC],
  		],
		]);

		$this->load($params);

		if(!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'title' => $this->title,
			'description' => $this->description,
			'created_at' => $this->created_at
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
					->andFilterWhere(['like', 'description', $this->description])
					->andFilterWhere(['created_at' => $this->created_at]);

		return $dataProvider;
	}
}