<?php
/* @var $this FunctionController */
/* @var $model TblFunction */

$this->breadcrumbs=array(
	'Tbl Functions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblFunction', 'url'=>array('index')),
	array('label'=>'Create TblFunction', 'url'=>array('create')),
	array('label'=>'View TblFunction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblFunction', 'url'=>array('admin')),
);
?>

<h1>Update TblFunction <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>