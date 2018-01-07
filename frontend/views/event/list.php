<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="site-index">
	<div class="col-md-10 content">
		<div class="content-inner">
		  <h1>Keywords</h1>

			<h2>Data</h2>
			<div class="grid-view-wrapper">
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'tableOptions' => [
						'class' => 'list',
					],
					'columns' => [
						'name_fi',
						'name_en',
						'name_sv',
						// 'last_modified_time',
						[

						'format' => 'html',
						'value' => function ($model) {
							   return Html::a('<span class="glyphicon glyphicon-zoom-in"></span>',  ['event/update', 'id' => $model->id], ['class' => 'icon']);
						   }
						],
						[

							'format' => 'raw',
							'value' => function ($model) {
							   $btn = Html::a('<span class="glyphicon glyphicon-remove-sign"></span>',  ['event/delete', 'id' => $model->id], 
												[
													'class' => 'icon',   										
													'data' => [
														'confirm' => "Are you sure you want to delete this record? ",
														'method' => 'post',
														
													],
												]);
							   return Html::decode($btn);
						   }
						],
					],
				]); ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 sidebar">
				<?= Yii::$app->view->render('_sidebar'); ?>
	</div>
</div>
