<?php
/**
 * Handle all requests from console.
 */
class CliRequest extends Dispatcher {
	# Used when console is open to initiate game. 
	protected $defaultParams = array('battle','newGame');
	
	/**
	 * Issue the specified user request through Cli.
	 *
	 * @return array
	 * @access public
	 */
	public function getParams() {
	  if(isset($GLOBALS['argv'][1])){
		$action = $GLOBALS['argv'][1];
		
		if(!empty($action)) {
			return array('battle',$action);
		}
	  }
		
		return $this->defaultParams;
	}
	
	/**
	 * Invoke required action
	 *
	 * @return void
	 * @access public
	 */
	public function invokeAction() {
		$ctrlClass = $this->getController();
		$action = $this->getAction();
		
		$controller = new $ctrlClass(new CliView());
		if(! method_exists($controller, $action)) {
			throw new Exception('Unknown action ' . $action . '.');
		}
		
		$controller->$action();
	}
}
