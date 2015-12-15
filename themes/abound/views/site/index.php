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
              'ajaxUpdate' => false,
              'columns'=>array(
                    array(
                        'header'=>'Agent',
                        'value'=>'$data["user"]',
                    ),
                    array(
                        'header'=>'Status',
                        'value'=>'$data["status"]',
                    ),
                    array(
                        'header'=>'Campaign ',
                        'value'=>'$data["campaign_id"]',
                    ),
                    array(
                        'header'=>'Action',
                        'type'=>'raw',
                        'value'=>'CHtml::link("disconnect", array("disconnect/agent","agent"=>$data[\'agent\']), array("class"=>"btn btn-default"))',
                    ),
                ),
            ));
        ?>
        <?php $this->endWidget(); ?>
	</div>
</div>

