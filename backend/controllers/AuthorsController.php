<?php

namespace backend\controllers;

use Yii;
use common\models\Authors;
use common\models\AuthorsSearch;
use yii\helpers\Html;

class AuthorsController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$searchModel = new AuthorsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$newModel = new Authors();

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'newModel' => $newModel
		]);
	}

	public function actionCreate()
	{
		$model = new Authors();

		if(Yii::$app->request->isAjax) {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return true;
			}
			$result = [];
			foreach ($model->getErrors() as $attribute => $errors) {
				$result[Html::getInputId($model, $attribute)] = $errors;
			}

			return $this->asJson(['validation' => $result]);
		}
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return true;
	}

	public function actionUpdate($id)
  {
    $model = $this->findModel($id);

   	if(Yii::$app->request->isAjax) {
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
	      return true;
	    } else {
	    	return $this->renderAjax('_form', [
	    		'model' => $model,
	    	]);
	    }
    }

  }

  public function actionGetJournals($id) {
  	$model = $this->findModel($id);
  	$journals = $model->journals;

  	$data = [];
  	foreach ($journals as $journal) {
  		array_push($data, [
  			'title' => $journal['title'],
  			'description' => $journal['description'],
  			'img' => $journal['img'],
  			'created_at' => $journal['created_at']
  		]);
  	}

  	return json_encode($data);
  }

	protected function findModel($id)
    {
      if (($model = Authors::findOne($id)) !== null) {
        return $model;
      }

      throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
    }

}