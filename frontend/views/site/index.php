<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
  <h1>Example website using Yii2 advanced template</h1>
  <hr />
  <?= Html::a('Manage records', ['event/list'], ['class' => 'btn btn-primary']) ?>
</div>
