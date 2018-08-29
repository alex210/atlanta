<?php

namespace common\models;

class Authors extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return 'authors';
	}

	public function rules()
	{
		return [
			[['name', 'surname'], 'required'],
			[['name'], 'string', 'min' => 2, 'max' => 255],
			[['surname'], 'string', 'min' => 3, 'max' => 255],
		];
	}

	public function attributeLabels()
	{
		return [
			'name' => 'Имя',
			'surname' => 'Фамилия'
		];
	}

	public function getJournals()
	{
		return $this->hasMany(Journals::className(), ['id' => 'journal_id'])
			->viaTable('{{%journal_has_authors}}', ['author_id' => 'id']);
	}
}