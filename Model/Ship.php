<?php

class Ship {
	protected $size;
	protected $name;
	protected $coordinates = array();
	
	public function __construct($size, $name){
		$this->size = $size;
		$this->name = $name;
	}
	
   /*
	* Return ship size.
	*
	* @return Integer
	* @access public
	*/
	public function getSize() {
		return $this->size;
	}

	/*
	 * Return ship name.
	*
	* @return String
	* @access public
	*/
	public function getName() {
		return $this->name;
	}
	

   /*
	* Set ship coordinates.
	*
	* @params String X Y ship coordinates 
	* @return void
	* @access public
	*/
	public function setCoordinate($xy){
		$this->coordinates = $xy;
	}
	
   /*
	* Check is ship hited.
	*
	* @params String X Y ship coordinates 
	* @return Boolean
	* @access public
	*/
	public function isHit($xy){
		//print_r($this->coordinates);
		return in_array($xy, $this->coordinates);
	}
	
   /*
	* Check is ship sunked.
	*
	* @return Boolean
	* @access public
	*/
	public function isSunk(){
		return empty($this->coordinates);
	}
	
   /*
	* Remove hited coordinate from ship.
	*
	* @params String X Y ship coordinates
	* @return void
	* @access public
	*/
	public function removeHitCoordinate($xy){
		if(($key = array_search($xy, $this->coordinates)) !== false) {
			unset($this->coordinates[$key]);
		}
		
	}
	
}

?>