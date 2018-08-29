<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(); ?>

	<?=$form->field($model, 'name')->textInput() ?>
	<?=$form->field($model, 'surname')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
	</div>

<?php ActiveForm::end(); ?>