<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\base\Model;


class AuthorsSearch extends Authors
{

	public function rules()
		{
			return [
				[['name', 'surname'], 'safe'],
			];
		}

	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Authors::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
      	'defaultOrder' => ['name' => SORT_DESC, 'surname' => SORT_DESC],
  		],
		]);

		$this->load($params);

		if(!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'name' => $this->name,
			'surname' => $this->surname
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
					->andFilterWhere(['like', 'surname', $this->surname]);

		return $dataProvider;
	}
}