<?php

namespace backend\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class RestController extends ActiveController
{

	public function behaviors()
	{
	    $behaviors = parent::behaviors();

	    // remove authentication filter
	    $auth = $behaviors['authenticator'];
	    unset($behaviors['authenticator']);
	    
	    // add CORS filter
	    $behaviors['corsFilter'] = [
	        'class' => \yii\filters\Cors::className(),
	    ];
	    
	    // re-add authentication filter
	    $behaviors['authenticator'] = $auth;
	    // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
	    $behaviors['authenticator']['except'] = ['options'];

	    return $behaviors;
	}

  public $modelClass = 'common\models\Journals';




}