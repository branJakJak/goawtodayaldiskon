<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 12/15/15
 * Time: 11:23 PM
 * To change this template use File | Settings | File Templates.
 */

class BaseJsonResponse {
    protected $message = array();
    protected $status;
    protected $messageContent;


	/**
	 * Gets the $status value
	 *
	 * @return string The value of status key of returned message
	 */
	public function getStatus() {
	    return $this->status;
	}

	/**
	 * Set the value of $status
	 *
	 * @param String $newstatus The value of status key of returned message
	 */
	public function setStatus($status) {
	    $this->status = $status;
	    return $this;
	}
    /**
     * Retrieves $messageContent data . 
     *
     * @return string The content of message key
     */
    public function getMessageContent() {
        return $this->messageContent;
    }
    
    /**
     * Sets the value $messageContent
     *
     * @param string $newmessageContent The content of message key
     */
    public function setMessageContent($messageContent) {
        $this->messageContent = $messageContent;
    
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function __toString()
    {
        return json_encode($this->message);
    }



}