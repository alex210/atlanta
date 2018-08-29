<?php

use yii\helpers\Html;
use yii\grid\GridView;
use lo\widgets\magnific\MagnificPopup;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="authors-index">

	<a href="#formAuthor" class="btn btn-primary" id="addAuthor">Добавить автора</a>

<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,

		'columns' => [
			'name',
			'surname',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete} {journals}',
				'headerOptions' => ['style' => 'width:25%'],
				'buttons' => [
					'delete' => function ($url) {
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
              'title' => Yii::t('yii', 'Delete'),
              'class' => 'deleteAuthor',
            ]);
          },
          'update' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#modalUpdateAuthor', [
            	'class' => 'updateAuthor',
            	'data-id' => $model->id,
            ]);
          },
          'journals' => function($url, $model) {
          	return Html::button('Журналы', [
            	'class' => 'getJournals',
            	'data-id' => $model->id,
            ]);
          }
				]
			],
		],
	]); ?>
<?= MagnificPopup::widget([
	'type' => 'inline',
	'target' => '.updateAuthor'
]); ?>
<?php Pjax::end(); ?>

</div>

<?= MagnificPopup::widget([
	'type' => 'inline',
	'target' => '#addAuthor'
]); ?>


<div id="modalUpdateAuthor" class="mfp-hide">
	<div class="wrapper"></div>
</div>

<?php $form = ActiveForm::begin(['options' => ['id' => 'formAuthor', 'class' => 'mfp-hide']]); ?>

	<?=$form->field($newModel, 'name')->textInput() ?>
	<?=$form->field($newModel, 'surname')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
	</div>

<?php ActiveForm::end(); ?>