<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

<div class="row-fluid">
	<div class="span10 offset1">
        <?php
    		$this->beginWidget('zii.widgets.CPortlet', array(
    			'title'=>'Agent Monitoring',
    			'titleCssClass'=>''
    	   ));
        ?>
        <?php 
            $this->widget('zii.widgets.grid.CGridView', array(
              'dataProvider'=>$dataprovider,

            ));
        ?>
        <?php $this->endWidget(); ?>
	</div>
</div>

