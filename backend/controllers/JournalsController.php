<?php

namespace backend\controllers;

use Yii;
use common\models\Journals;
use common\models\JournalsSearch;
use yii\helpers\Html;
use yii\web\UploadedFile;

class JournalsController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$searchModel = new JournalsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider
		]);
	}

	public function actionCreate()
  {
    $model = new Journals();

    if(Yii::$app->request->isAjax) {
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
        
      	if($model->file = UploadedFile::getInstanceByName('file')) {
	        if(!$model->upload()){
		     		die(json_encode(array('error' => 'Ошибка')));
	        }
        }

        return true;
      } else {
      	return $this->renderAjax('_form', [
	    		'model' => $model,
	    	]);
      }
    }
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

   	if(Yii::$app->request->isAjax) {
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        if($model->file = UploadedFile::getInstanceByName('file')) {
	        if(!$model->upload()){
		     		die(json_encode(array('error' => 'Ошибка')));
	        }
        }

				return true;
	    } else {
	    	return $this->renderAjax('_form', [
	    		'model' => $model,
	    	]);
	    }
    }
  }


  public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return true;
	}

  protected function findModel($id)
  {
    if (($model = Journals::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
  }

}
