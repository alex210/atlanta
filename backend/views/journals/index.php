<?php

use yii\helpers\Html;
use yii\grid\GridView;
use lo\widgets\magnific\MagnificPopup;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use \yii\helpers\StringHelper;
use kartik\date\DatePicker;

$this->title = 'Журналы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="journals-index">
	
	<a href="#modalCreateJournal" class="btn btn-primary" id="addJournal">Добавить журнал</a>

	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,

		'columns' => [
			'title',
			[
				'attribute' => 'description',
				'value' => function($model) {
					return StringHelper::truncate($model->description, 30, '...');
				}
			],
			[
				'attribute' => 'img',
				'format' => 'raw',
				'value' => function($model) {
					return Html::img('/uploads/'.$model->img, ['class' => 'imgMin']);
				}
			],
			[
				'attribute' => 'created_at',
				'filter' => DatePicker::widget([
					'model' => $searchModel,
					'attribute' => 'created_at',
					'pluginOptions' => [
            'autoclose' => false,
            'format' => 'yyyy-mm-dd',
           ]
				]) 
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'delete' => function ($url) {
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
              'title' => Yii::t('yii', 'Delete'),
              'class' => 'deleteJournal',
            ]);
          },
          'update' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#modalUpdateJournal', [
            	'class' => 'updateJournal',
            	'data-id' => $model->id,
            ]);
          },
				]
			],
		],
	]); ?>

<?= MagnificPopup::widget([
	'type' => 'inline',
	'target' => '.updateJournal'
]); ?>

<?php Pjax::end(); ?>



<?= MagnificPopup::widget([
	'type' => 'inline',
	'target' => '#addJournal'
]); ?>

<div id="modalCreateJournal" class="mfp-hide">
	<div class="wrapper"></div>
</div>

<div id="modalUpdateJournal" class="mfp-hide">
	<div class="wrapper"></div>
</div>


</div>

