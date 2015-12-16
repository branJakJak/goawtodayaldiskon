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





Yii::app()->clientScript->registerCssFile($baseUrl.'/plugins/alertify.js-0.3.11/themes/alertify.core.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/plugins/alertify.js-0.3.11/themes/alertify.default.css');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/plugins/alertify.js-0.3.11/lib/alertify.min.js', CClientScript::POS_END);



?>
<script type="text/javascript">
    window.agentCollection = {};
    window.canUpdateTable = true;
    function addToCollection(currentElement){
        var numOfProps = 0;
        if (currentElement.checked) {
            window.agentCollection[currentElement.value] = currentElement.value;
        }else{
            delete window.agentCollection[currentElement.value];
        }
        numOfProps = Object.keys(window.agentCollection).length;
        if (numOfProps <= 0) {
            window.canUpdateTable = true;
        }else{
            window.canUpdateTable = false;
        }
        // Update user about the number of selected agents*/
        jQuery(".numSelectedAgents").text(Object.keys(window.agentCollection).length);
    }
    function pauseSelected() {
        var default_pause_code ="PAUSE";
        alertify.prompt("Message", function (e, str) {
            if (e) {
                default_pause_code =  str;
            }
            alertify.log("Sending message. Please wait.");
            for(var propertyName in window.agentCollection) {
                window.pauseUser(window.agentCollection[propertyName]  , default_pause_code);
            }

        }, "Pause code");
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
        alertify.log("Logging out selected agent(s). Please wait.");
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
    function hungUpSelected()
    {
        alertify.log("Hunging up user agent(s). Please wait.");
        for(var propertyName in window.agentCollection) {
            window.hungUpAgent(window.agentCollection[propertyName]);
        }
    }
    function hungUpAgent(current_agent) {
        jQuery.get('/hungUp/agent', {'agent': current_agent}, function(data, textStatus, xhr) {
            if (data.status == 'ok') {
                alertify.success(current_agent + " is now hunged up");
            }else{
                alertify.error("Cant hung "+current_agent);
            }
            window.canUpdateTable = true;
        });
        
    }
    /**
     * Logs out all users
     */
    function logoutAllUser(){
        alertify.log("Logging out all user agents. Please wait.");
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
        var messageStr = " ";
        alertify.prompt("Message", function (e, str) {
            if (e) {
                messageStr = str;
            }
            alertify.log("Sending message. Please wait.");
            for(var propertyName in window.agentCollection) {
                window.send_message(window.agentCollection[propertyName] , messageStr);
            }
        }, "Message");
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

</script>
<div class="row-fluid">
	<div class="span10 offset1">
        <?php
    		$this->beginWidget('zii.widgets.CPortlet', array(
    			'title'=>'Agent Monitoring',
    			'titleCssClass'=>''
    	   ));
        ?>

        <div style="padding: 30px" class='pull-left'>
            <h3>
                Action <span class="badge numSelectedAgents">0</span>
                <small>Apply action to selected users</small>
            </h3>
            <div class="btn-group">
                <button onclick="pauseSelected()" type="button" class="btn btn-default">
                    Agent Pause code
                </button>
                <button onclick="hungUpSelected()" type="button" class="btn btn-default">
                    Hungup User
                </button>
                <button type="button" class="btn btn-default" onclick="logoutSelectedUser()">
                    Logout user
                </button>
                <button type="button" class="btn btn-default" onclick="sendMessageToSelected()">
                    Send message
                </button>
            </div>
        </div>

        <div style="padding: 30px;padding-top : 90px;" class='pull-right'>
            <div class="btn-group">
                <button onclick="logoutAllUser()" type="button" class="btn btn-default">
                    <span class='icon-off'></span> Logout all
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
                        'header'=>'Reason',
                        'value'=>'$data["reason"]',
                    ),
                    array(
                        'header'=>'Time',
                        'value'=>'$data["time"]',
                    ),
                    array(
                        'header'=>'Calls today',
                        'value'=>'$data["calls_today"]',
                    ),
                    array(
                        'header'=>'Campaign ID',
                        'value'=>'$data["campaign_id"]',
                    ),
                    array(
                        'header'=>'Phone number',
                        'value'=>'$data["phone_number"]',
                    ),
                    array(
                        'header'=>'Term reason ',
                        'value'=>'$data["term_reason"]',
                    ),
                ),
                'htmlOptions'=>array('id'=>'goautodial')
            ));
        ?>

        <?php $this->endWidget(); ?>
	</div>
</div>

