<?php
/* @var $this PrizedrawController */
/* @var $model PrizeDraw */

$this->breadcrumbs=array(
	'Price Draws'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PrizeDraw', 'url'=>array('index')),
	array('label'=>'Manage PrizeDraw', 'url'=>array('admin')),
);
?>

<h1>Create PrizeDraw</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>