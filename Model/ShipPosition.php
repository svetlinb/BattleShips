<?php
/*
 * Handle with ship disposal over grid. 
 * Provide tools for Base Model class.
 */
class ShipPosition implements IBattleField {
	protected $shipSize;
	protected $grid;
	protected $shipCoordinates = array();

   /*
	* Set ship size.
	*
	* @params Integer
	* @return void
	* @access public
	*/
	public function setShipSize($size) {
		$this->shipSize = $size;
	}

	/*
	* Set ship size.
	*
	* @params Array
	* @return void
	* @access public
	*/
	public function setGrid($grid) {
		$this->grid = $grid;
	}
	
	/*
	* Return grid.
	*
	* @return Array
	* @access public
	*/
	public function getGrid() {
		return $this->grid;
	}
	public function getShipCoordinates() {
		return $this->shipCoordinates;
	}

   /*
	* Determine direction of ship x- horizontal, y- vertical.
	*
	* @return String
	* @access public
	*/
	public function getXYPosition() {
		return (mt_rand(0, 1) == 1 ? 'x' : 'y');
	}

   /*
	* Genreate random placement for the ship.
	*
	* @return Array
	* @access public
	*/
	public function generateRandomCoordinates() {
		// Maximum values on grid
		// Subtract $size from the max value to compensate for ship size
		$max = (IBattleField::FIELDSIZE) - $this->shipSize;
		
		// Generate random placement
		$x = mt_rand(0, $max);
		$y = mt_rand(0, $max);
		
		return array('x'=>$x,'y'=>$y);
	}

   /*
	* Check given coordinates.
	*
	* @return Boolean
	* @access public
	*/
	public function checkXYPosition($coordinates, $pos) {
		$find = true;
		
		for($i = 0; $i < $this->shipSize; $i ++) {
			// Check current position is free
			if(! empty($this->grid[$coordinates['x']][$coordinates['y']])) {
				$find = false;
				break;
			}
			$coordinates[$pos] ++;
		}
		return $find;
	}
	
   /*
	* Check for free position on battle field where to place ships.
	*
	* @return void
	* @access public
	*/
	public function addShip() {
		$coordinates = array();
		$pos = null;
		$isPosFound = false;
		$pos = $this->getXYPosition();
		$coordinates = $this->generateRandomCoordinates();
		$isPosFound = $this->checkXYPosition($coordinates, $pos);
		
		if(! $isPosFound) {
			$this->addShip();
		}else {
			unset($this->shipCoordinates);
			for($i = 0; $i < $this->shipSize; $i ++) {
				$this->grid[$coordinates['x']][$coordinates['y']] = IBattleField::SHIP;
				$this->shipCoordinates[] = $coordinates['x'] . $coordinates['y'];
				$coordinates[$pos] ++;
			}
		}
	}
}

?>