<?php 
use yii\bootstrap\Progress;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="site-index">
<?php Pjax::begin(); ?>
  <h1>Update data</h1>

	<?php
	
	
	
	echo '<a href='. Url::to(['update/index']).' class="btn btn-lg btn-primary" onclick="updateStatus()" >Update records</a>';
	// echo Html::a("Update records", ['update/index'], ['class' => 'btn btn-lg btn-primary', 'onclick' => 'updateStatus();']);
	
	echo '<div id="status">';
	
	if(isset($proc))
		echo $proc;
	
	echo Progress::widget([
		'percent' => 60,
		'label' => 'test',
	]);
	
	echo '</div>';
	
	Pjax::end();
	?>
</div>

<script>
    function updateStatus() {
		console.log("trigger")
        $.pjax.reload({container:'#status', type:'POST', url: "<?= Url::to(['update/status'], 'http') ?>"});
    }
</script>