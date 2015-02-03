<?php
/*
 * Provide Game interface for web users.
*/
class WebView extends HtmlDecorator implements IView, IBattleField {
  protected  $data;
  protected  $grid;
  protected  $statistic;
  protected  $message;

 /*
  * Pass data to display
  *
  * @params Array
  * @return void
  * @access public
  */
  public function setData($data){
    $this->data = $data;
  }
  
 /*
  * Pass messages to display
  *
  * @params String
  * @return void
  * @access public
  */
  public function setMessage($msg){
  	$this->message = $msg;
  }
  
 /*
  * Prepare user interface to begin a game
  *
  * @return void
  * @access public
  */
  public function generateGrid(){
	  	# Display the grid
  		$this->grid .= '<br />';
	  	$this->grid .= '<p class="error">'.$this->message.'</p>';
	  	$this->grid .= '<br />';
	  	$this->grid .= '<table width="300" height="300" border="1">';
	  	$this->grid .=  '<tr>';
  	for ( $row = 0; $row < IBattleField::FIELDSIZE+1; $row++ ) {
  		$this->grid .=  '<th width="30" align="center">'.(($row > 0)?$row:"&nbsp;").'</th>';
  	}
  		$this->grid .=  '</tr>';
  	for ( $row = 0; $row < IBattleField::FIELDSIZE; $row++ ) {
  		$this->grid .=  '<tr>';
  		$this->grid .= '<th width="30" align="center">'.range('A', 'J')[$row].'</th>';
  		for( $col = 0; $col < IBattleField::FIELDSIZE; $col++ ) {
  			$this->grid .=  '<td width="30" align="center">';
  			$this->grid .=  ( isset($this->data[$row][$col]) ? $this->data[$row][$col] : '&nbsp;' );
  			$this->grid .=  '</td>';
  		}
  		$this->grid .=  '</tr>';
  	
  	}
  	$this->grid .= '</table>';
  }
  
 /*
  * Display game inteface.
  *
  * @return void
  * @access public
  */
  public function display() {
  	$this->generateGrid();
	$this->render();
  }
  
}
