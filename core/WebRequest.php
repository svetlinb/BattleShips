<?php
/**
 * Handle all requests from Web.
 */
class WebRequest extends Dispatcher {
	
	protected $defaultParams = array('battle','newGame');
	
	/**
	 * Issue the specified user request through Cli.
	 *
	 * @return array
	 * @access public
	 */
	public function getParams() {
		if(! empty($_SERVER['QUERY_STRING'])) {
			$parts = explode('&', $_SERVER['QUERY_STRING']);
			return explode('-', $parts[0]);
		}else {
			return $this->defaultParams;
		}
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
		
		$controller = new $ctrlClass(new WebView());
		
		if(! method_exists($controller, $action)) {
			throw new Exception('Unknow action ' . $action . '.');
		}
		
		$controller->$action();
	}
}

