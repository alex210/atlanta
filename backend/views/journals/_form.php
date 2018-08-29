<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use \yii\helpers\ArrayHelper;
use \dosamigos\selectize\SelectizeDropDownList;
use \common\models\Authors;
use kartik\file\FileInput;
use yii\helpers\Url;

$form = ActiveForm::begin([
	'options' => ['enctype' => 'multipart/form-data']
]); ?>

	<?=$form->field($model, 'title')->textInput() ?>
	<?=$form->field($model, 'description')->textInput() ?>

	<?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
	  'pluginOptions' => [
	    'autoclose' => true,
	    'format' => 'yyyy-mm-dd'
	  ]
	]); ?>

  <?php
    $authors = Authors::find()->asArray()->all();
    echo $form->field($model, 'rel_author')->label('Авторы:')
      ->widget(SelectizeDropDownList::className(),
        ['items' => ArrayHelper::map($authors, 'id', 'surname'),
          'options' => ['multiple' => true, 'class' => 'form-control'],
          'clientOptions' => ['plugins' => ['remove_button']]
        ]);
  ?>


  <?php/* $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
    	'uploadUrl' => Url::to(['/journals/uploads/']),
    ]
	]); */?>
	<?=$form->field($model, 'file')->fileInput()?>



	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

<?php ActiveForm::end(); ?>
