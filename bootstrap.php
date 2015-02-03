<?php
/**
 *
 * Handles loading of all files needed on every request.
 * A better aproach to handle with this problem is to 
 * use autoloader, but because due out of time was choosen
 * current aproach.
 *
 */
require './paths.php';
require './core/Dispatcher.php';
require './core/RequestHandler.php';
require './core/WebRequest.php';
require './core/CliRequest.php';
require './Model/IBattleField.php';
require './Model/SaveData.php';
require './Model/XYCoordinatesConvertor.php';
require './Model/ShipPosition.php';
require './Model/Ship.php';
require './Model/ProceedAction.php';
require './Model/BattleField.php';
require './Controller/Battle.php';
require './View/IView.php';
require './View/HtmlDecorator.php';
require './View/WebView.php';
require './View/CliView.php';
