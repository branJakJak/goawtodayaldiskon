<?php
/* @var $this ValueController */
/* @var $model TblValue */

$this->breadcrumbs=array(
	'Tbl Values'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblValue', 'url'=>array('index')),
	array('label'=>'Create TblValue', 'url'=>array('create')),
	array('label'=>'Update TblValue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblValue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblValue', 'url'=>array('admin')),
);
?>

<h1>View TblValue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'function_name',
		'date_created',
		'date_updated',
	),
)); ?>
