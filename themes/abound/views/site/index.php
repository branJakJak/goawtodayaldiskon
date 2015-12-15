<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 

$autoUpdate = <<<EOL
setInterval(function(){
    $.fn.yiiGridView.update('goautodial'); 
},3000);
EOL;
Yii::app()->clientScript->registerScript('autoUpdate', $autoUpdate, CClientScript::POS_READY);
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
        $this->widget('bootstrap.widgets.TbAlert', array(
            'fade'=>true,
            'closeText'=>'×', 
            'alerts'=>array( 
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
                'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
            ),
        )); ?>
        <?php 
            $this->widget('bootstrap.widgets.TbGridView', array(
              'id'=>"goautodial",
              'type'=>"stripped bordered",
              'dataProvider'=>$dataprovider,
              'ajaxUpdate' => true,
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
                        'value'=>'CHtml::link("disconnect", array("disconnect/agent","agent"=>$data["user"] ), array("class"=>"","confirm"=>"Are you sure you want to disconnect this agent/user ? "))',
                    ),
                ),
            ));
        ?>
        <?php $this->endWidget(); ?>
	</div>
</div>

