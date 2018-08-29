<?php

namespace common\models;

use Yii;
use voskobovich\linker\LinkerBehavior;
use yii\web\UploadedFile;
use yii\helpers\Url;


class Journals extends \yii\db\ActiveRecord
{
	public $file;

	public function behaviors(){
    return [
      'relations' => [
        'class' => LinkerBehavior::className(),
          'relations' => [
            'rel_author' => [
              'authors'
            ]
          ]
      ]
    ];
  }

  public function upload()
  {
		if ($this->validate()) { 
  		$dir = Yii::getAlias('uploads/');
  		$this->img = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6).'.'.$this->file->extension;
  		$this->save();
  		$this->file->saveAs($dir.$this->img);
      return true;
    } else {
      return false;
    }
  }

	public static function tableName()
	{
		return 'journals';
	}

	public function rules()
	{
		return [
			[['title', 'rel_author'], 'required'],
			[['title'], 'string', 'min' => 3, 'max' => 255],
			[['description'], 'string', 'max' => 255],
			[['img'], 'string', 'max' => 255],
			[['file'], 'image', 'extensions' => 'jpg, png', 'maxSize' => 5 * 1048576],
			[['created_at'], 'string'],
			[['rel_author'], 'each', 'rule' => ['integer']]
		];
	}

	public function attributeLabels()
	{
		return [
			'title' => 'Название',
			'description' => 'Описание',
			'img' => 'Картинка',
			'file' => 'Картинка',
			'created_at' => 'Дата выпуска'
		];
	}

	public function getAuthors()
	{
		return $this->hasMany(Authors::className(), ['id' => 'author_id'])
			->viaTable('{{%journal_has_authors}}', ['journal_id' => 'id']);
	}

	public function fields()
{
    return [
        'id',
        'title',
        'description',
        'img' => function() {
        	return Url::home(true).'uploads/'.$this->img;
        },
        'authors' => 'authors'
    ];
}
}