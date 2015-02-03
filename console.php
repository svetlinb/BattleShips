<?php
require_once 'bootstrap.php';

/*
 * Start point for console interaction.
 */

try {
	$request = new CliRequest ();
	$request->dispatch ();
} catch(Exception $e) {
	echo $e->getMessage ();
}