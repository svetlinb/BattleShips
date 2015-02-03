<?php
/*
* Handle with user actions.
* Provide tools for Base Model class.
*
*/
class ProceedAction {
      protected $hitCoordinate;
      protected $convertedCoordinateArray;
      protected $coordinateString;
      protected $shipPosition;
      
     /*
      * Check is there a ship on that position
      *
      * @return Boolean
      * @access protected
      */
      protected function isHit(){
      	$grid = $this->saveData->get()['unhiddenField'];
      	
      	if(isset($grid[$this->convertedCoordinateArray['x']][$this->convertedCoordinateArray['y']])){
      		if($grid[$this->convertedCoordinateArray['x']][$this->convertedCoordinateArray['y']] == IBattleField::SHIP){
      			return true;
      		}
      	}
      	 
      	return false;
      }
      
     /*
      * Set proper mark on this coordinate.
      *
      * @return void
      * @access protected
      */
      protected function setHitStatus($hitStatus){
      	$this->persistObject['playField'][$this->convertedCoordinateArray['x']][$this->convertedCoordinateArray['y']] = $hitStatus;
      	$this->saveData->save($this->persistObject);
      }

     /*
      * Save user hits for future use.
      *
      * @return void
      * @access protected
      */
      protected function saveUserHits(){
      	$this->persistObject['userHits'][] = $this->hitCoordinate;
      	$this->saveData->save($this->persistObject);
      }

     /*
      * Check user hit.
      *
      * @return Boolean
      * @access protected
      */
      protected function isHitAlreadyPlay(){
      	return (isset($this->persistObject['userHits'])) ? in_array($this->hitCoordinate, $this->persistObject['userHits']) : false;
      }
      
     /*
      * Check for ship status.
      *
      * @return Boolean
      * @access protected
      */
      protected function isShipSunk(){
      	$isSunk = false;
      	$ships = $this->persistObject['ships'];
      	
      	for ($i=0; $i < count($ships); $i++){
      		if($ships[$i]->isHit($this->shipPosition)){
      			$ships[$i]->removeHitCoordinate($this->shipPosition);
      			if($ships[$i]->isSunk()){
      				unset($ships[$i]);
      				$isSunk = true;
      			}
      			break;
      		}
      	}
      	$ships = array_values($ships);
      	$this->persistObject['ships'] = $ships;
      	$this->saveData->save($this->persistObject);
      	
      	return $isSunk;
      }
      
     /*
      * Check for game status.
      *
      * @return Boolean
      * @access protected
      */
      protected function isGameOver(){
      	return empty($this->getData()['ships']);
      }
      
     /*
      * Validate user input.
      *
      * @return Boolean
      * @access protected
      */
      protected function validateCoordinates(){ 
      	return (bool)preg_match('/^([a-j])([1-9]|10)$/i', $this->hitCoordinate);
      }

     /*
      * Get user hit try count.
      *
      * @return Integer
      * @access protected
      */
      protected function getUserTryes(){
      	return count($this->persistObject['userHits']);
      }
	
}

?>