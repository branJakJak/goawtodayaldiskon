<?php 

/**
 * GoAutodialRemoteCommandInterface
 * All classes who wants to "do" something to GoAutoDial Remote server
 * @package default
 * @author 
 **/
interface GoAutodialRemoteCommandInterface
{
	public function send($httParams);
} // END interface GoAutodialRemoteCommandInterface