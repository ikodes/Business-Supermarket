<?php
/* @var $this PrizedrawController */
/* @var $model PriceDraw */

$this->breadcrumbs=array(
	'Price Draws'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceDraw', 'url'=>array('index')),
	array('label'=>'Manage PriceDraw', 'url'=>array('admin')),
);
?>

<h1>Create PriceDraw</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>