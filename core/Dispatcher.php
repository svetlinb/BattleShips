<?php
/**
 * Dispatcher takes the URL or Cli information, parse it for paramters and
 * tells the involved controllers what to do.
 * 
 */
abstract class Dispatcher {
	
	protected $params = array ();
	
	/*
	 * Load given params from children classes.
	 */
	public function __construct() {
		$this->params = $this->getParams();
	}
	
	abstract function getParams();
	
	abstract function invokeAction();
	
	/**
	 * Dispatches the request, creating appropriate models and controllers.
	 * 
	 * @return void
	 * @access public
	 */
	public function dispatch() {
		$this->invokeAction ();
	}

	/**
	 * Get controller from request.
	 *
	 * @return void
	 * @access protected
	 */
	protected function getController() {
		$ctrlClass = ucfirst($this->params[0]);
		
		if(! class_exists($ctrlClass)) {
			throw new Exception('Unknown action ' . $ctrlClass . '.');
		}
		
		return $ctrlClass;
	}

	/**
	 * Get action from request.
	 *
	 * @return mixed String or Null if no 
	 * @access protected
	 */
	protected function getAction() {
		if(! empty($this->params[1])) {
			return $this->params[1];
		}
		return null;
	}
}

?>