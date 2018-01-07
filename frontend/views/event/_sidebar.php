<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="sidebar-inner">
	<h2 class="sidebar">Options</h2>
	<ul class="sidebar">

	<li>
	<?= Html::a('Update all data',  ['event/data'], 
												[
													'class' => 'link-danger',   										
													'data' => [
														'confirm' => "Are you sure you want to update all records? This may take time.",
														'method' => 'post',
														
													],
												]); ?>
	</li>
	<li>
	<?= Html::a('Remove all data',  ['event/truncate'], 
												[
													'class' => 'link-danger',   										
													'data' => [
														'confirm' => "Are you sure you want to delete all records? ",
														'method' => 'post',
														
													],
												]); ?>
	</li>
	</ul>
</div>