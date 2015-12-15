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
              'columns'=>array(
                    array(
                        'header'=>'Agent',
                        'value'=>'$data["agent"]',
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
                        'value'=>'<button onclick="disconnectUser(\'$data["agent"]\')" type="button" class="btn btn-default">disconnect</button>',
                    ),
                ),
            ));
        ?>
        <?php $this->endWidget(); ?>
	</div>
</div>

