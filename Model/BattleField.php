<?php
/*
 * Base model class.
 * All application bussines logic is made here.
 * 
 */
class BattleField extends ProceedAction implements IBattleField {
	protected $fieldData;
	protected $hitTry;
	protected $message;
	protected $persistObject = array ();
	protected $ships = array ();
	
	/*
	 * Prepare ships that will be placed on battle field.
	 * Init nedded helper classes.
	 */
	public function __construct() {
		$this->ships = array (
				new Ship ( 5, 'BattleShip' ),
				new Ship ( 4, 'Destroyer' ),
				new Ship ( 4, 'Destroyer' ) 
		);
		$this->saveData = new SaveData ();
		$this->shipPosition = new ShipPosition ();
		$this->proceedAction = new ProceedAction ();
	}
	
	/*
	 * Prepare grid field to begin a game
	 *
	 * @return void
	 * @access public
	 */
	public function initField() {
		for($x = 0; $x < IBattleField::FIELDSIZE; $x ++) {
			for($y = 0; $y < IBattleField::FIELDSIZE; $y ++) {
				$this->fieldData [$x] [$y] = IBattleField::BLANK;
			}
		}
		
		$this->persistObject ['playField'] = $this->fieldData;
		$this->saveData->save ( $this->persistObject );
		$this->disposeShips();
	}
		
	/*
	 * Place ship over battle field on random positions.
	 *
	 * @return void
	 * @access protected
	 */
	protected function disposeShips() {
		// Clear field to dispose ships
		$this->fieldData = null;
		$this->shipPosition->setGrid($this->fieldData);
		
		foreach($this->ships as $ship) {
			$this->shipPosition->setShipSize($ship->getSize());
			$this->shipPosition->addShip();
			$ship->setCoordinate($this->shipPosition->getShipCoordinates());
			$ships[] = $ship;
		}
		
		$this->persistObject['ships'] = $ships;
		$this->persistObject['unhiddenField'] = $this->shipPosition->getGrid();
		$this->saveData->save($this->persistObject);
	}
		
	/*
	 * Cares for user game interaction.
	 * Get given hit coordinates and process them.
	 * 
	 * @return void
	 * @access public
	 */
	public function proceed($hitCoordinate) {
		$this->hitCoordinate = ! empty($hitCoordinate['xy']) ? $hitCoordinate['xy'] : $hitCoordinate;
		
		if($this->validateCoordinates()) {
			$this->convertedCoordinateArray = XYCoordinatesConvertor::convertToArray($this->hitCoordinate);
			$this->shipPosition = XYCoordinatesConvertor::convertToString($this->hitCoordinate);
			$this->persistObject = $this->saveData->get();
			
			if($this->isHitAlreadyPlay()) {
				$this->message = 'This coordinates are already played.';
			}else {
				$this->saveUserHits($hitCoordinate);
				
				if(! $this->isHit($this->hitCoordinate)) {
					$this->setHitStatus(IBattleField::MISS);
					$this->message = 'Miss';
				}else {
					$this->message = 'Hit!';
					$this->setHitStatus(IBattleField::HIT);
					
					if($this->isShipSunk()) {
						$this->message = 'Hit! Congrats you sunk this ship.';
					}
					
					if($this->isGameOver()) {
						$this->message = 'Well done! You completed the game in' . $this->getUserTryes() . ' shots';
					}
				}
			}
		}else {
			$this->message = 'Ivalid coordinates. Please try again.';
		}
	}
	
   /*
	* Read saved game data and pass it.
	*
	* @return mixed Array, Object, String
	* @access public
	*/
	public function getData() {
		return $this->fieldData = $this->saveData->get();
	}
	
   /*
	* Get proper message and pass it to user.
	*
	* @return String
	* @access public
	*/
	public function getMsg() {
		return $this->message;
	}
  

}
