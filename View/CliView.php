<?php
/*
 * Provide Game interface for console users.
 */
class CliView implements IView {
	protected $data;
	protected $grid;
	protected $statistic;
	protected $message;
	
   /*
	* Pass data to display
	* 
	* @params Array
	* @return void
	* @access public
	*/
	public function setData($data) {
		$this->data = $data;
	}
	
   /*
	* Pass messages to display
	*
	* @params String
	* @return void
	* @access public
	*/
	public function setMessage($msg) {
		$this->message = $msg;
	}
	
   /*
	* Prepare user interface to begin a game
	*
	* @return void
	* @access public
	*/
	public function generateGrid() {
		echo '---------------=HELP=-------------------' . "\r\n";
		echo 'Available commands: newGame, cheat, play' . "\r\n";
		echo 'How to use example:                      ' . "\r\n";
		echo ' 		  php console.php newGame   ' . "\r\n";
		echo ' 		  php console.php cheat   ' . "\r\n";
		echo ' 		  php console.php play a1   ' . "\r\n";
		echo '-----------------------------------------' . "\r\n";
		
		// Display the grid
		$this->grid .= $this->message . "\r\n";
		$this->grid .= "\r\n";
		for($row = 0; $row < IBattleField::FIELDSIZE + 1; $row ++) {
			$this->grid .= " " . (($row > 0) ? $row : "");
		}
		$this->grid .= "\r\n";
		for($row = 0; $row < IBattleField::FIELDSIZE; $row ++) {
			// $this->grid .= "\r\n";
			$this->grid .= range('A', 'J')[$row];
			for($col = 0; $col < IBattleField::FIELDSIZE; $col ++) {
				$this->grid .= " " . (isset($this->data[$row][$col]) ? $this->data[$row][$col] : "  ");
			}
			$this->grid .= "\r\n";
		}
	}
	
   /*
	* Display game inteface.
	*
	* @return void
	* @access public
	*/
	public function display() {
		$this->generateGrid();
		echo $this->grid;
	}
}
