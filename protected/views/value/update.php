<?php
/* @var $this ValueController */
/* @var $model TblValue */

$this->breadcrumbs=array(
	'Tbl Values'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblValue', 'url'=>array('index')),
	array('label'=>'Create TblValue', 'url'=>array('create')),
	array('label'=>'View TblValue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblValue', 'url'=>array('admin')),
);
?>

<h1>Update TblValue <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>