<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;

?>

<div class="site-index">
<div class="row">
	<div class="col-md-10 content">
		
		<h1>Keyword: <?= isset($model->name_fi) ? $model->name_fi : " " ?></h1>
		<div class="content-inner">
		<?php
		if (isset($errors) && !empty($errors)) { ?>
		<div class="alert alert-warning">
			<?= var_dump($errors); ?>
		</div>
		<?php
		} ?>

			<?php
			$form = yii\widgets\ActiveForm::begin([
				'id' => 'update-form',
				// 'options' => ['class' => 'form-horizontal'],
			])
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="row names">
					
						<div class="col-md-12 form-name">
						<h2>Names</h2>
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

				<div class="col-md-6">
					<div class="row">
					
						<div class="col-md-12">
						<h2>Dates</h2>
							<p><b>Time created</b></p>
							<?= DateTimePicker::widget([
								'model' => $model,
								'attribute' => 'created_time',
								'options' => ['placeholder' => 'Time created...'],
								'convertFormat' => true,
								'pluginOptions' => [
									'format' => 'yyyy-MM-dd HH:mm:ss',
									'todayHighlight' => true
								]
							]); ?>
						</div>
						<div class="col-md-12">
							<p><b>Last modified</b></p>
							<?= DateTimePicker::widget([
								'model' => $model,
								'attribute' => 'last_modified_time',
								'options' => ['placeholder' => 'Last modified time...'],
								'convertFormat' => true,
								'pluginOptions' => [
									'format' => 'yyyy-MM-dd HH:mm:ss',
									'todayHighlight' => true
								]
							]); ?>
						</div>

					</div>
				</div>

				<div class="col-md-6">
				
					<div class="row">
					
						<div class="col-md-12">
						<h2>Aggregate?</h2>
						<?= $form->field($model, 'aggregate')->radioList([0 => 'no', 1 => 'yes'])->label(false) ?>
						</div>

					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-12">
				<div class="buttons">
				<p><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></p>
				<p><?= Html::a('Cancel', ['event/list'], ['class' => 'btn btn-danger']) ?></p>
				</div>
			</div>
			</div>
			<?php yii\widgets\ActiveForm::end(); ?>
	
		</div>
	</div>
	<div class="col-md-2 sidebar">
		    <?= Yii::$app->view->render('_sidebar'); ?>
	</div>

</div>
