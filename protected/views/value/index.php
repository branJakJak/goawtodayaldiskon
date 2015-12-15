<?php
/* @var $this ValueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Values',
);

$this->menu=array(
	array('label'=>'Create TblValue', 'url'=>array('create')),
	array('label'=>'Manage TblValue', 'url'=>array('admin')),
);
?>

<h1>Tbl Values</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
