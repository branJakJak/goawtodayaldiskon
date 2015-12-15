<?php
/* @var $this FunctionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Functions',
);

$this->menu=array(
	array('label'=>'Create TblFunction', 'url'=>array('create')),
	array('label'=>'Manage TblFunction', 'url'=>array('admin')),
);
?>

<h1>Tbl Functions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
