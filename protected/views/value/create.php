<?php
/* @var $this ValueController */
/* @var $model TblValue */

$this->breadcrumbs=array(
	'Tbl Values'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblValue', 'url'=>array('index')),
	array('label'=>'Manage TblValue', 'url'=>array('admin')),
);
?>

<h1>Create TblValue</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>