<?php 
require_once 'bootstrap.php';

/*
 * Start point for web interaction.
*/

try {
	$request = new WebRequest();
	$request->dispatch();
}catch(Exception $e) {
	echo $e->getMessage();
}
