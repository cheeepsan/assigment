<?php
use yii\grid\GridView;

?>

<div class="site-index">
  <h1>Available events</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'tableOptions' => [
			'class' => 'search-results',
		],
        'columns' => [
			'name_fi',
			'name_en',
			'name_sv',
			'last_modified_time',
           
        ],
    ]); ?>
   
</div>
