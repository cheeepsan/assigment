<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\jui\DatePicker;

?>

<div class="site-index">
	<div class="col-md-10 content">
		<div class="content-inner">
		<?php
		if (isset($errors)) { ?>
		<div class="alert alert-warning">
			<?= var_dump($errors); ?>
		</div>
		<?php
		} ?>
		  <h1>Keyword: <?= isset($model->name_fi) ? $model->name_fi : " " ?></h1>
			<?php
			$form = yii\widgets\ActiveForm::begin([
				'id' => 'update-form',
				'options' => ['class' => 'form-horizontal'],
			])
			?>
			<div class="col-md-12">
				<div class="row names">
				<h2>Name</h2>
					<div class="col-md-12 form-name">
					<?= $form->field($model, 'name_fi')->textInput(['placeholder' => $model->attributeLabels()['name_fi']]) ?>
					</div>
					<div class="col-md-12 form-name">
					<?= $form->field($model, 'name_en')->textInput(['placeholder' => $model->attributeLabels()['name_en']]) ?>
					</div>
					<div class="col-md-12 form-name">
					<?= $form->field($model, 'name_sv')->textInput(['placeholder' => $model->attributeLabels()['name_sv']])?>
					</div>
				</div>
			</div>			
			<?php /*
			<div class="col-md-6">
				<div class="row">
				<h2>Dates</h2>
					<div class="col-md-12">

					<?= DatePicker::widget([
							'model' => $model,
							'attribute' => 'created_time',
							//'language' => 'ru',
							//'dateFormat' => 'yyyy-MM-dd',
						]); ?>
					</div>
					<div class="col-md-12">
					<?= DatePicker::widget([
							'model' => $model,
							'attribute' => 'last_modified_time',
							//'language' => 'ru',
							'dateFormat' => 'yyyy-MM-dd',
						]); ?>
					</div>

				</div>
			</div>
			*/ ?>
			<div class="col-md-12">
			
				<div class="row">
				<h2>Aggregate?</h2>
					<div class="col-md-12">
					
					<?= $form->field($model, 'aggregate')->radioList([0 => 'no', 1 => 'yes'])->label(false) ?>
					</div>

				</div>
			</div>
			<p><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></p>
			<p><?= Html::a('Cancel', ['event/list'], ['class' => 'btn btn-danger']) ?></p>
			<?php yii\widgets\ActiveForm::end(); ?>
	
		</div>
	</div>
	<div class="col-md-2 sidebar">
		    <?= Yii::$app->view->render('_sidebar'); ?>
	</div>
</div>
