<?php
/**
 * Issue the specified request that comes from console or web.
 */
class RequestHandler {
	/**
	 * Handle Cli request
	 *
	 * @return mixed String or Null
	 * @access public
	 */
	public static function cli() {
		return (! empty($GLOBALS['argv'][2])) ? $GLOBALS['argv'][2] : null;
	}
	
	/**
	 * Handle Web requst
	 *
	 * @param mixed $key String or Null
	 * @return mixed null if empty $_POST, String if $key is given otherwise Array.
	 * @access public
	 */
	public static function post($key = NULL) {
		return (! empty($key)) ? $_POST[$key] : $_POST;
	}
	
	/**
	 * This method cares which request to be routed to contrller
	 *
	 * @param mixed String or NUll
	 * @return mixed String or Array
	 * @access public
	 */
	public static function getRequest($key = NULL) {
		return (! empty(RequestHandler::post($key))) ? RequestHandler::post($key) : RequestHandler::cli();
	}
}

?>