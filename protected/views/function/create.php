<?php
/* @var $this FunctionController */
/* @var $model TblFunction */

$this->breadcrumbs=array(
	'Tbl Functions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblFunction', 'url'=>array('index')),
	array('label'=>'Manage TblFunction', 'url'=>array('admin')),
);
?>

<h1>Create TblFunction</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>