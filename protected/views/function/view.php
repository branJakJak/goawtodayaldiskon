<?php
/* @var $this FunctionController */
/* @var $model TblFunction */

$this->breadcrumbs=array(
	'Tbl Functions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblFunction', 'url'=>array('index')),
	array('label'=>'Create TblFunction', 'url'=>array('create')),
	array('label'=>'Update TblFunction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblFunction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblFunction', 'url'=>array('admin')),
);
?>

<h1>View TblFunction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'function_name',
		'date_created',
		'date_updated',
	),
)); ?>
