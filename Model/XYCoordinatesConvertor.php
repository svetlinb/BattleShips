<?php
/*
 * Convert given user hit coordinate to integers that can be used
 * as array indexes.
 * For Ex.: A1 ->  array('x'=>0, 'y'=>0), C6 -> array('x'=>2, 'y'=>5)
 * Provide tools for Base Model class.
 */
class XYCoordinatesConvertor {
   /*
	* Convert user coordinates to string.
	* Ex.: A1 -> 00
	* This format is used from Ship class.
	*
	* @params String
	* @return String
	* @access public
	*/
	public static function convertToString($xyCoordinates){
		$xyCoordinates = strtolower($xyCoordinates);
		$alphaRange = range('a', 'j');
		$xyArr = preg_split('/(\d+)/', $xyCoordinates, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$convertedXY = array_search($xyArr[0], $alphaRange);
		$convertedXY .= $xyArr[1]-1;
		
	  return $convertedXY;
	}
	
   /*
	* Convert user coordinates to array.
	* Ex.: C6 -> array('x'=>2, 'y'=>5)
	* This format is used from Base model class.
	*
	* @params String
	* @return Array
	* @access public
	*/
	public static function convertToArray($xyCoordinates){
		$xyCoordinates = strtolower($xyCoordinates);
		$alphaRange = range('a', 'j');
		$xyArr = preg_split('/(\d+)/', $xyCoordinates, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$convertedX = array_search($xyArr[0], $alphaRange);
		$convertedY = $xyArr[1]-1;
		
	  return array('x'=>$convertedX, 'y'=>$convertedY);
	}
}

?>