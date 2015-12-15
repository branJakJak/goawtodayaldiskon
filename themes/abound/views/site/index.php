<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 

$autoUpdate = <<<EOL


setInterval(function(){
    if (window.canUpdateTable) {
        $.fn.yiiGridView.update('goautodial'); 
    }
},5000);
EOL;
Yii::app()->clientScript->registerScript('autoUpdate', $autoUpdate, CClientScript::POS_READY);

?>
<script type="text/javascript">
    window.agentCollection = {};
    window.canUpdateTable = true;
    function addToCollection(currentElement){
        if (currentElement.checked) {
            window.agentCollection[currentElement.value] = currentElement.value;
        }else{
            delete window.agentCollection[currentElement.value];
        }
        window.canUpdateTable = false;//pause the auto update

        // Update user about the number of selected agents*/
        jQuery(".numSelectedAgents").text(Object.keys(window.agentCollection).length);
    }
    function pauseSelected() {
        var default_pause_code ="PAUSE";
        alertify.prompt("Message", function (e, str) {
            if (e) {
                default_pause_code =  str;
            }
        }, "Pause code");
        for(var propertyName in window.agentCollection) {
            window.pauseUser(window.agentCollection[propertyName]  , default_pause_code);
        }
    }
    /**
     * Pause the user agent
     */
    function pauseUser(useragent , pause_code){
        jQuery.get('/pause/agent', {agent: useragent , 'pause_code' : pause_code}, function(data, textStatus, xhr) {
            if (data.status == 'ok') {
                alertify.success(useragent + " pause code updated");
            }else{
                alertify.error(useragent + "' pause code cannot be updated");
            }
        });
    }
    function logoutSelectedUser() {
        for(var propertyName in window.agentCollection) {
            window.logoutUser(window.agentCollection[propertyName]);
        }
    }
    /**
     * Logs out one user
     */
    function logoutUser(useragent) {
        jQuery.get('/remoteLogout/agent', {agent:useragent}, function(data, textStatus, xhr) {
            if (data.status == 'ok') {
                alertify.success(useragent + " is now logged out");
            }else{
                alertify.error(useragent + " cannot be logged out");
            }
            window.canUpdateTable = true;
        });
    }
    /**
     * Logs out all users
     */
    function logoutAllUser(){
        jQuery.get('/remoteLogout/all', null, function(data, textStatus, xhr) {
            if (data.status == 'ok') {
                alertify.success("All users are logged out");
            }else{
                alertify.error("Logout all action failed");
            }
            window.canUpdateTable = true;
        });
    }
    function sendMessageToSelected() {
        var messageStr = "";
        alertify.prompt("Message", function (e, str) {
            if (e) {
                messageStr = str;
            }
        }, "Message");
        for(var propertyName in window.agentCollection) {
            window.send_message(window.agentCollection[propertyName] , messageStr);
        }
    }
    /**
     * Send message
     */
    function send_message(agent, message){
        jQuery.get('/agent/showScreen', {'user': agent,'message':message}, function(data, textStatus, xhr) {
           if (data.status == 'ok') {
                alertify.success("Message sent to "+agent);
            }else{
                alertify.error("Cant send message to "+agent);
            }
            window.canUpdateTable = true;
        });
    }
    /**
     * Puts screen message to user agent
     */
    function put_screen_message (usergent , message) {
        /*@TODo - after ajax update window.canUpdateTable = true*/
    }



</script>
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

        <div style="padding: 30px" class='pull-left'>
            <h3>
                Action <span class="badge numSelectedAgents">0</span>
                <small>Apply action to selected users</small>
            </h3>
            <div class="btn-group">
                <button onclick="pauseSelected()" type="button" class="btn btn-default">
                    Pause Agents
                </button>
                <button type="button" class="btn btn-default" onclick="logoutSelectedUser()">
                    Logout user
                </button>
                <button type="button" class="btn btn-default" onclick="sendMessageToSelected()">
                    Send message
                </button>
            </div>
        </div>

        <div style="padding: 30px;padding-top : 60px;" class='pull-right'>
            <div class="btn-group">
                <button onclick="pauseSelected()" type="button" class="btn btn-default">
                    <span class='icon-off'></span>Logout all
                </button>
            </div>
        </div>
        <div class="clearfix"></div>


        <?php 
            $allData = $dataprovider->data;
            $this->widget('bootstrap.widgets.TbGridView', array(
              'type'=>"stripped bordered",
              'dataProvider'=>$dataprovider,
              'ajaxUpdate' => true,
              'columns'=>array(
                    array(
                            'name'=>'',             
                            'value'=>'CHtml::checkBox("cid[]",null,array("onclick"=>"addToCollection(this)","value"=>$data["user"],"id"=>"cid_".$data["user"]))',
                            'type'=>'raw',
                            'htmlOptions'=>array('width'=>5),
                        ),
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
                        'type'=>'raw',
                        'value'=>'CHtml::link("pause", array("pause/agent","agent"=>$data["user"] ), array("class"=>"","confirm"=>"Are you sure you want to PAUSE this agent/user ? "))',
                    )
                ),
            'htmlOptions'=>array('id'=>'goautodial')
            ));
        ?>

        <?php $this->endWidget(); ?>
	</div>
</div>

