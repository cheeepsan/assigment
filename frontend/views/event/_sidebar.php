<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="sidebar-inner">
	<h2 class="sidebar">Navigation</h2>
	<ul>
	<?php
	echo '<li><a href='. Url::to(['event/data']).' class="" >Update records</a></li>';
	?>
	</ul>
</div>